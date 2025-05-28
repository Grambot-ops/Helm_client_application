<?php

namespace App\Livewire;

use App\Models\Participation;
use App\Models\Submission;
use App\Models\Competition;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SubmissionPage extends Component
{
    public Submission $submission;
    public Competition $competition;

    public function mount(Request $request)
    {
        $id = $request->id;

        $this->submission = Submission::findOrFail($id);
        $this->competition = $this->submission->participation->competition;
    }

    #[Layout('layouts.tmcp', ['title' => 'Submission', 'page_author' => 'Yussef'])]
    public function render()
    {
        return view('livewire.submission-page');
    }
}
