<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Participation;
use App\Models\Submission;
use App\Models\Vote;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewSubmissions extends Component
{
    public $showModalDelete = false;
    public $showModalInfo = false;
    public $submissionToDelete;
    public $submissionToShowInfo;

    public $competition;

    public function mount(Request $request)
    {
        $id = $request->id;
        if(!isset($id))
            abort(404);

        // Get competition
        $this->competition = Competition::where('id', $id)
            ->firstOrFail();
    }


    #[Layout('layouts.tmcp', ['title' => 'Submissions', 'description' => 'all submissions from the competitions'])]
    public function render()
    {
        $competition = $this->competition;
        $submissions = Submission::whereIn(
            'participation_id',
            Participation::select('id')
                ->where('competition_id', $this->competition->id)
                ->get()
        )->get();
        return view('livewire.view-submissions', compact('submissions', 'competition'));
    }


    public function openDelete(Submission $submission)
    {
        $this->submissionToDelete = $submission;
        $this->showModalDelete = true;
    }
    public function closeDelete(){
        $this->showModalDelete = false;
    }

    public function deleteSubmission()
    {
        $this->submissionToDelete->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The submission \"<b><i>{$this->submissionToDelete->title}</i></b>\" has been deleted",
        ]);
        $this->submissionToDelete = null;
        $this->showModalDelete = false;
    }

    public function openInfo(Submission $submission){
        $this->submissionToShowInfo = $submission;
        $this->showModalInfo = true;
    }
    public function closeInfo(){
        $this->showModalInfo = false;
        // Not setting this to `null` triggers a bug where the modal tries to
        // show info about a modal that doesn't exist anymore, causing Livewire
        // to throw a 404
        $this->submissionToShowInfo = null;
    }

    public function vote(Submission $submission)
    {
        // The code to check if the maximum number of votes has been reached can be added here if needed

        // If the user has already voted, delete the vote
        if ($submission->votes->contains('user_id', auth()->id())) {
            $submission->votes()->where('user_id', auth()->id())->delete();
        } else {
            $vote = new Vote;
            $vote->user_id = auth()->id();
            $submission->votes()->save($vote);
        }
    }
}
