<?php

namespace App\Livewire\Forms;

use App\Models\CompetitionCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public $id = null;

    #[Validate('required')]
    public $name = null;

    public function read(CompetitionCategory $category)
    {
        $this->id = $category->id;
        $this->name = $category->name;
    }
    public function update(CompetitionCategory $category)
    {
        $this->validate();
        $category->update([
            'name' => $this->name,
        ]);
    }
    public function delete(CompetitionCategory $category)
    {
        $category->delete();
    }
}
