<?php
namespace App\Livewire\Admin;

use App\Models\Competition;
use App\Models\Participation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ApplyForCompetition extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'apply', 'description' => 'Apply for competition',])]

    public $competition;
    public function mount(Request $request)
    {
        $id = urldecode($request->query('id'));
        /* FIXME: return a custom error page when competition isn't found? */
        $this->competition = Competition::where('id', $id)->firstOrFail();
    }

    public function apply()
    {
        Participation::create([
            'competition_id' => $this->competition->id,
            'user_id' => auth()->id(),
            'ranking' => 0,
            'disqualified' => false,
        ]);

        // Redirect to homepage
        return Redirect::to('/');
    }

    public function render()
    {
        return view('livewire.admin.apply-for-competition');
    }
}

