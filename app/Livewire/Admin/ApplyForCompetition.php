<?php
namespace App\Livewire\Admin;

use App\Models\Competition;
use App\Models\Participation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ApplyForCompetition extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'apply', 'description' => 'Apply for competition',])]
    public $buttonDisabled = false;
    public $competition;
    public $participation;
    public function mount(Request $request)
    {

        $id = urldecode($request->query('id'));
        $this->competition = Competition::where('id', $id)->firstOrFail();
        $this->participation = Participation::where('competition_id', $this->competition->id)
            ->where('user_id', auth()->id())
            ->first();    }

    public function apply()
    {
        $isParticipant = Participation::where('competition_id', $this->competition->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($isParticipant) {
            $this->dispatch('swal:toast', [
                'background' => 'warning',
                'html' => "You are already a participant in this competition.",
                'icon' => 'warning',
            ]);
            return;
        }

        $this->buttonDisabled = true;
        Participation::create([
            'competition_id' => $this->competition->id,
            'user_id' => auth()->id(),
            'ranking' => 0,
            'disqualified' => false,
        ]);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "You have applied!",
            'icon' => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.see-more-info', [
            'competition' => $this->competition,
            'applicationDate' => $this->participation->application_date,
            'submissionDate' => $this->participation->submission_date,
        ]);
    }

}

