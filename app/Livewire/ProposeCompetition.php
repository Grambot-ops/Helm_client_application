<?php

namespace App\Livewire;

use App\Livewire\Forms\CompetitionForm;
use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public function mount(Request $request)
    {
        if($request->id == null)
        {
            return;
        }
        $this->competition = Competition::where('id', $request->id ?? 0)->first();

        if($this->competition->user_id != Auth::id())
        {
            session()->flash('message', 'You are not the organizer of this competition.');
            session()->flash('error', 1);
            $this->redirectRoute('dashboard');
            return;
        }
    }

    public function updateCompetition(Competition $competition)
    {
        $this->form->update($competition);
        session()->flash('message', 'Your competition has been edited.');
        session()->flash('success', 1);
        $this->redirectRoute('apply', ['id' => urlencode($competition->id)]);
    }

    #[Layout('layouts.tmcp', ['title' => 'Propose Competition', 'description' => 'Thomas More Competition Platform'])]
    public function render(Request $request)
    {
        $id = $request->id;

        if($this->competition) {
            $this->resetErrorBag();

            $this->form->fill($this->competition);
        }

        $competition_types = CompetitionType::orderBy('name')->get();
        $competition_categories = CompetitionCategory::orderBy('name')->get();
        $pretty_names = Competition::getFileTypes();
        return view('livewire.propose-competition', compact('competition_types', 'competition_categories', 'pretty_names'));
    }
}
