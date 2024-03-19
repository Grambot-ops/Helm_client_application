<?php

namespace App\Livewire\Admin;

use App\Models\Competition;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class ApplyForCompetition extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'apply', 'description' => 'Apply for competition',])]

    public function render(Request $request)
    {
        $id = urldecode($request->query('id'));
        /* FIXME: return a custom error page when competition isn't found? */
        $competition = Competition::where('id', $id)->firstOrFail();

        return view('livewire.admin.apply-for-competition', compact('competition'));
    }

}
