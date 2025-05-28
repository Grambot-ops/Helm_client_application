<?php

namespace App\Livewire\Forms;

use App\Models\CompetitionCategory;
use App\Models\CompetitionType;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TypeForm extends Form
{
    public $id = null;

    #[Validate('required')]
    public $name = null;

    public function read(CompetitionType $type)
    {
        $this->id = $type->id;
        $this->name = $type->name;
    }
    public function update(CompetitionType $type)
    {
        $this->validate();
        $type->update([
            'name' => $this->name,
        ]);
    }
    public function delete(CompetitionType $type)
    {
        $type->delete();
    }
}
