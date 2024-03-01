<?php

namespace App\Livewire\Forms;

use App\Models\CompetitionCategory;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Http;
use Illuminate\Support\Facades\Storage;
use Image;

class CategoryForm extends Form
{
    public $id = null;
    #[Validate('required', as: 'name of the artist')]
    public $name = null;

    // read the selected record
    public function read($category)
    {
        $this->id = $category->id;
        $this->name = $category->artist;
    }

    // create a new record
    public function create()
    {
        $this->validate();
        CompetitionCategory::create([
            'name' => $this->name,
        ]);
    }

    // update the selected record
    public function update(CompetitionCategory $category) {
        $this->validate();
        $category->update([
            'name' => $this->name,
        ]);
    }

    // delete the selected record
    public function delete(CompetitionCategory $category)
    {
        $category->delete();
    }
}
