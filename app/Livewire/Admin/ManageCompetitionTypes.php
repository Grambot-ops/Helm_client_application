<?php
//"competition type" should be named "submission type"
namespace App\Livewire\Admin;

use App\Livewire\Forms\TypeForm;
use App\Models\Competition;
use App\Models\CompetitionType;
use App\Models\Submission;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ManageCompetitionTypes extends Component
{
    use WithPagination;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search;
    public $perPage = 5;
    public $showModal = false;
    public TypeForm $form;


    // add new competition
    public $showNewModal = false;
    public bool $newTypeIsFile;
    public $newType;

    public $acceptedFileTypes = [
        'image' => false,
        'video' => false,
        'audio' => false,
        'document' => false,
    ];

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'perPage']))
            $this->resetPage();
    }
    public function editType(CompetitionType $type)
    {
        $this->resetErrorBag();
        $this->form->fill($type);
        $this->showModal = true;
    }
    public function newType()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
    }

    public function deleteType(CompetitionType $type)
    {
        if ($type->competitions()->exists()) {
            $this->dispatch('swal:toast', [
                'background' => 'error',
                'html' => "Cannot delete the type <b><i>{$type->name}</i></b> as it has associated competitions.",
                'icon' => 'error',
            ]);
            return;
        }

        $this->form->delete($type);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The type <b><i>{$type->name}</i></b> has been deleted",
            'icon' => 'success',
        ]);
    }

    public function createType()
    {
        $validatedData = $this->validate([
            'newType' => 'required|bail|filled|unique:competition_types,name',
        ], [
            'newType.unique' => 'The type name has already been taken.',
        ]);

        // This is the worst kind of serialization I have ever written
        $formats = '';
        foreach($this->acceptedFileTypes as $key => $fileType) {
            if($fileType)
                $formats .= $key . ',';
        }
        $formats = rtrim($formats, ',');

        if(!$this->newTypeIsFile)
            $formats = null;

        CompetitionType::create([
            'name' => trim($validatedData['newType']),
            'is_file' => $this->newTypeIsFile,
            'filetypes' => $formats,
        ]);

        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The type <b><i>{$this->newType}</i></b> has been added",
            'icon' => 'success',
        ]);

        $this->showNewModal = false;
    }
    public function updateType(CompetitionType $type)
    {
        $existingType = CompetitionType::where('name', $this->form->name)
            ->where('id', '!=', $type->id)
            ->exists();

        if ($existingType) {
            $this->addError('form.name', 'That type name already exists.');
            return;
        }
        $this->form->update($type);
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The record <b><i>{$this->form->name}</i></b> has been updated",
            'icon' => 'success',
        ]);
    }

    #[Layout('layouts.tmcp', ['title' => 'types', 'description' => 'Manage the types of your competitions',])]
    public function render()
    {
        $query = CompetitionType::orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $types = $query->paginate($this->perPage);

        $pretty_names = CompetitionType::getFileTypes();

        return view('livewire.admin.manage-competition-types', compact('types', 'pretty_names'));
    }

    public function resort($column)
    {
        $this->orderBy === $column ?
            $this->orderAsc = !$this->orderAsc :
            $this->orderAsc = true;
        $this->orderBy = $column;
    }
}
