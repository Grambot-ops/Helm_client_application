<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DetermineWinners extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'DetermineWinners', 'description' => 'Thomas More Competition Platform','page_author' => 'Ian'])]
    public function render()
    {
        return view('livewire.admin.determine-winners');
    }
}
