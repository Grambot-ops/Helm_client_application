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
    public $orderBy = 'name';
    public $orderAsc = true;
    #[Layout('layouts.tmcp', ['title' => 'Manage Users',])]
    public function render()
    {
        $query = User::orderBy('id')
            ->searchName($this->search);
        $users = $query
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.admin.users', compact('users'));
    }
}
