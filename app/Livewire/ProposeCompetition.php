<?php

namespace App\Livewire;

use App\Livewire\Forms\CompetitionForm;
use App\Models\CompetitionCategory;
use App\Models\CompetitionType;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Component;

class ProposeCompetition extends Component
{
    use WithFileUploads;

    public CompetitionForm $form;

    public $termsOfAgreement = false;

    public function createCompetition()
    {
        $this->form->create();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The competition <b><i>{$this->form->title}</i></b> has been proposed",
            'icon' => 'success',
       ]);
    }

    #[Layout('layouts.tmcp', ['title' => 'Propose Competition', 'description' => 'Thomas More Competition Platform'])]
    public function render()
    {
        $competition_types = CompetitionType::orderBy('name')->get();
        $competition_categories = CompetitionCategory::orderBy('name')->get();
        return view('livewire.propose-competition', compact('competition_types', 'competition_categories'));
    }
}
