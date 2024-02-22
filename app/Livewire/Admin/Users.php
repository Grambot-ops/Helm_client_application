<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Users extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'Manage Users',])]
    public function render()
    {
        return view('livewire.admin.users');
    }
}
