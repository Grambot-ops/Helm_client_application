<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\UserForm;
use App\Models\User;
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

    #[Validate([
        'editUser.name' => 'required|min:3|max:30|unique:User,name',
        'editUser.email' => 'required|email|unique:email',
    ], as: [
        'editUser.name' => 'name for this user',
        'editUser.email' => 'email for this user'
    ])]
    public $editUser = ['id' => null, 'name' => null, 'email' => null, 'active' => false];

    // reset all the values and error messages
    public function resetValues()
    {
        $this->reset('editUser');
        $this->resetErrorBag();
    }

    public function editUser(User $user)
    {
        $this->resetErrorBag();
        $this->form->fill($user);
        $this->showModal = true;
    }

    public function update(User $user)
    {
        $this->editUser['name'] = trim($this->editUser['name']);
        $this->editUser['email'] = trim($this->editUser['email']);
        #$this->validateOnly('editUser.name');
        $oldName = $user->name;
        $user->update([
            'name' => trim($this->editUser['name']),
        ]);
        #$this->validateOnly('editUser.email');
        $oldEmail = $user->email;
        $user->update([
            'email' => trim($this->editUser['email']),
        ]);
        $this->resetValues();
        if (strtolower($this->editUser['name']) !== strtolower($oldName)) {
            $this->dispatch('swal:toast', [
                'background' => 'success',
                'html' => "The user <b><i>{$oldName}</i></b> has been updated to <b><i>{$user->name}</i></b>",
            ]);
        }
        if (strtolower($this->editUser['email']) !== strtolower($oldEmail)) {
            $this->dispatch('swal:toast', [
                'background' => 'success',
                'html' => "The user <b><i>{$oldEmail}</i></b> has been updated to <b><i>{$user->email}</i></b>",
            ]);
        }
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
