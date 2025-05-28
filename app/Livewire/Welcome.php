<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Welcome extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'Welcome','page_author' => 'Katoo'])]
    public function render()
    {
        return view('livewire.welcome');
    }
}
