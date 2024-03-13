<?php

namespace App\Livewire;

use App\Livewire\Forms\CategoryForm;
use App\Models\Competition;
use App\Models\CompetitionCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ManageCompetitionCategories extends Component
{
    use WithPagination;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search;
    public $perPage = 5;
    public $newCategory;
    public $showModal = false;
    public CategoryForm $form;

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'perPage']))
            $this->resetPage();
    }
    public function editCategory(CompetitionCategory $category)
    {
        $this->resetErrorBag();
        $this->form->fill($category);
        $this->showModal = true;
    }
    public function newCategory()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
    }

    public function deleteCategory(CompetitionCategory $category)
    {
        $this->form->delete($category);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The category <b><i>{$category->name}</i></b> has been deleted",
            'icon' => 'success',
        ]);
    }

    public function createCategory()
    {
        $validatedData = $this->validate([
            'newCategory' => 'required|unique:competition_categories,name',
        ], [
            'newCategory.unique' => 'The category name has already been taken.',
        ]);

        CompetitionCategory::create([
            'name' => trim($validatedData['newCategory'])
        ]);

        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The record <b><i>{$this->form->name}</i></b> has been added",
            'icon' => 'success',
        ]);
    }
    public function updateCategory(CompetitionCategory $category)
    {
        $this->form->update($category);
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The record <b><i>{$this->form->name}</i></b> has been updated",
            'icon' => 'success',
        ]);
    }

    #[Layout('layouts.tmcp', ['title' => 'categories', 'description' => 'Manage the categories of your competitions',])]
    public function render()
    {
        $query = CompetitionCategory::orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $categories = $query->paginate($this->perPage);

        return view('livewire.manage-competition-categories', compact('categories'));
    }

    public function resort($column)
    {
        $this->orderBy === $column ?
            $this->orderAsc = !$this->orderAsc :
            $this->orderAsc = true;
        $this->orderBy = $column;
    }
}
