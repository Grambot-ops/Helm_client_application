<?php

namespace App\Livewire\Admin;

use App\Models\Competition;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AcceptCompetition extends Component
{
    public function acceptCompetition(Competition $competition): void
    {
        $competition->update(['accepted' => true]);
        $this->redirectRoute('admin.accept-competition');
        $this->dispatch('swal:toast',
            [
                'background' => 'success',
                'html' => "The proposal <b><i>{$competition->name}</i></b> has accepted!",
                'icon' => 'success'
            ]
        );
    }

    public function declineCompetition(Competition $competition): void
    {
        $competition->update(['declined' => true]);
        $this->redirectRoute('admin.accept-competition');
        $this->dispatch('swal:toast',
            [
            'background' => 'success',
            'html' => "The proposal <b><i>{$competition->name}</i></b> has declined.",
            'icon' => 'success'
            ]
        );
    }

    #[Layout('layouts.tmcp', ['title' => 'Proposals', 'description' => 'Thomas More Competition Platform'])]
    public function render(Request $request)
    {
        $id = urldecode($request->query('id'));

        if($id) {
            $proposal = Competition::where('id', $id)->firstOrFail();

            if($proposal->accepted || $proposal->declined)
                abort(419, "This proposal has already been accepted/declined!");

            return view('livewire.competition-info', compact('proposal'));
        }

        $proposals = Competition::where('accepted', '=', 0)->where('declined', '=', 0)->get();

        return view('livewire.admin.accept-competition', compact('proposals'));
    }
}
