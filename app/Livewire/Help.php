<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Help extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'Help', 'page_author' => 'Niels'])]
    public function render()
    {
        return view('livewire.help');
    }
}
