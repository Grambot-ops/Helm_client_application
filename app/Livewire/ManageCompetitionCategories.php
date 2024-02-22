<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageCompetitionCategories extends Component
{
    #[Layout('layouts.tmcp')]
    public function render()
    {
        return view('livewire.manage-competition-categories');
    }
}
