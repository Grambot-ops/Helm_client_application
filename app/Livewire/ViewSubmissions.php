<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Participation;
use App\Models\Submission;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewSubmissions extends Component
{
    public $showModalDelete = false;
    public $showModalInfo = false;
    public $submissionToDelete;
    public $submissionToShowInfo;


    #[Layout('layouts.tmcp', ['title' => 'Submissions', 'description' => 'all submissions from the competitions'])]
    public function render(Request $request)
    {
        $id = $request->id;
        if(!isset($id))
            abort(404);

        // Get competition
        $competition = Competition::where('id', $id)
            ->firstOrFail();

        $submissions = Submission::whereIn(
            'participation_id',
            Participation::select('id')
                ->where('competition_id', $id)
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
            'html' => "The submission <b><i>{$this->submissionToDelete->id}</i></b> has been deleted",
        ]);
        $this->showModalDelete = false;
    }

    public function openInfo(Submission $submission){
        $this->submissionToShowInfo = $submission;
        $this->showModalInfo = true;
    }
    public function closeInfo(){
        $this->showModalInfo = false;
    }

}
