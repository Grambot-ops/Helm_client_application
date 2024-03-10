<?php

namespace App\Livewire;

use App\Models\Submission;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewSubmissions extends Component
{
    public $showModalDelete = false;
    public $showModalInfo = false;

    #[Layout('layouts.tmcp', ['title' => 'Submissions', 'description' => 'all submissions from the competitions'])]
    public function render()
    {
        $submissions = Submission::orderBy('id')
            ->get();
        return view('livewire.view-submissions', compact('submissions'));
    }

    public $Submission = ['id' => null, 'description' => null];
    public function openDelete(Submission $submission): void
    {
        $this->Submission = [
            'id' => $submission->id,
            'description' => $submission->description,
        ];

        $this->showModalDelete = true;
    }
    public function closeDelete(){
        $this->showModalDelete = false;
    }

    public function deleteSubmission(Submission $submission)
    {
        $submission->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The submission <b><i>{$submission->id}</i></b> has been deleted",
        ]);
        $this->showModalDelete = false;
    }

    public function openInfo(Submission $submission){
        $this->Submission = [
            'id' => $submission->id,
            'description' => $submission->description,
        ];

        $this->showModalInfo = true;
    }
    public function closeInfo(){
        $this->showModalInfo = false;
    }

}
