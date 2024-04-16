<?php

namespace App\Livewire;

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
        $competition = urldecode($request->query('id'));
        $competition_name = urldecode($request->query('title'));

        $submissions = Submission::orderBy('id')
            ->get();
        return view('livewire.view-submissions', compact('submissions', 'competition', 'competition_name'));
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
