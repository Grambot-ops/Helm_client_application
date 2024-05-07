<?php

namespace App\Livewire;

use App\Livewire\Forms\CompetitionForm;
use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Component;

class ProposeCompetition extends Component
{
    use WithFileUploads;

    public CompetitionForm $form;
    public $competition;

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

    public function updateRecord(Competition $competition)
    {
        $this->form->update($competition);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The competition <b><i>{$this->form->title}</i></b> has been edited",
            'icon' => 'success',
        ]);
    }

    #[Layout('layouts.tmcp', ['title' => 'Propose Competition', 'description' => 'Thomas More Competition Platform'])]
    public function render(Request $request)
    {
        $id = $request->id;

        $this->competition = Competition::where('id', $id ?? 0)->first();

        if($this->competition) {
            $this->resetErrorBag();
            $this->form->fill($this->competition);
        } else {
            $this->form->number_of_votes_allowed = 1;
            $this->form->number_of_uploads = 3;
        }
        $competition_types = CompetitionType::orderBy('name')->get();
        $competition_categories = CompetitionCategory::orderBy('name')->get();
        return view('livewire.propose-competition', compact('competition_types', 'competition_categories'));
    }
}
