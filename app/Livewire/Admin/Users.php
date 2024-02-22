<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 5;
    #[Layout('layouts.tmcp', ['title' => 'Manage Users',])]
    public function render()
    {
        $query = User::orderBy('id')
            ->searchName($this->search);
        $users = $query
            ->paginate($this->perPage);
        return view('livewire.admin.users', compact('users'));
    }

    public function updated($propertyName, $propertyValue)
    {
        // reset if the $search or $perPage property has changed (updated)
        if (in_array($propertyName, ['search', 'perPage']))
            $this->resetPage();
    }
}
