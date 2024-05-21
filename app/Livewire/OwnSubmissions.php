<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Participation;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OwnSubmissions extends Component
{
    public $competition;
    public $participations;

    public function deleteSubmission(Submission $submission)
    {
        $submission->delete();
    }

    public function mount(Request $request)
    {
        $id = $request->id;
        $this->competition = Competition::findOrFail($id);
        $this->participations = Participation::where('user_id', Auth::id())
            ->where('competition_id', $this->competition->id)
            ->first();
        if(!isset($this->participations)) {
            session()->flash('message', 'You are not a participant in this competition!');
            $this->redirectRoute('dashboard');
        }
    }

    #[Layout('layouts.tmcp', ['title' => "View your own submissions", 'page_author' => 'Yussef'])]
    public function render()
    {
        $submissions = Submission::where('participation_id', $this->participations->id)->get();

        return view('livewire.own-submissions', compact('submissions'));
    }
}
