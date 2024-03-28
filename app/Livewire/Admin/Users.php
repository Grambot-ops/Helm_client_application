<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\UserForm;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 5;
    public $showModal = false;
    public UserForm $form;
    #[Layout('layouts.tmcp', ['title' => 'Manage Users',])]
    public function render()
    {
        $userRoles = UserRole::with('roles')->get();
        \Log::info($userRoles);
        $users = User::orderBy('id')
            ->searchName($this->search)
            ->paginate($this->perPage);
        return view('livewire.admin.users', compact('users', 'userRoles'));
    }

    public function updated($propertyName, $propertyValue)
    {
        // reset if the $search or $perPage property has changed (updated)
        if (in_array($propertyName, ['search', 'perPage']))
            $this->resetPage();
    }

    public $editUser = ['id' => null, 'surname' => null, 'name' => null, 'email' => null, 'active' => false];

    // reset all the values and error messages
    public function resetValues()
    {
        $this->reset('editUser');
        $this->form->reset();
        $this->resetErrorBag();
    }

    public function editUsers(User $user)
    {
        $this->resetErrorBag();
        $this->form->fill($user);
        if ($this->form->active == 1)
            $this->form->active = true;
        else
            $this->form->active = false;
        $this->showModal = true;
    }

    public function updateUser(User $user): void
    {
        $this->form->update($user);
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The user <b><i>{$this->form->name}</i></b> has been updated",
            'icon' => 'success',
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The user <b><i>{$user->name}</i></b> has been deleted",
        ]);
    }
}
