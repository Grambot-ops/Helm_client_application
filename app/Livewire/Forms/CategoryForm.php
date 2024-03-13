<?php

namespace App\Livewire\Forms;

use App\Models\CompetitionCategory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public $id = null;

    // Validation rule for the name field
    #[Validate('required')]
    public $name = null;

    // Read the selected record
    public function read(CompetitionCategory $category)
    {
        $this->id = $category->id;
        $this->name = $category->name; // Assuming 'name' is the correct attribute
    }

    // Update the selected record
    public function update(CompetitionCategory $category)
    {
        $this->validate();
        $category->update([
            'name' => $this->name,
        ]);
    }

    // Delete the selected record
    public function delete(CompetitionCategory $category)
    {
        $category->delete();
    }
}
