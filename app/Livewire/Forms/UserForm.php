<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public $id = null;
    #[Validate('required', as: 'name of the user')]
    public $name = null;
    #[Validate('required', as: 'surname of the user')]
    public $surname = null;
    #[Validate('required|email', as: 'email for this user')]
    public $email = null;
    #[Validate('required|bool', as: 'is this user active?')]
    public $active = null;
    public $role = null;
    public function read($user)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;
        $this->active = $user->active;
        $this->role = $user->role;
    }

    public function update(User $user)
    {
        $this->validate();
        if ($this->active)
            $this->active = 1;
        else
            $this->active = 0;
        $user->update([
            'name' => $this->name,
            'surname' => $this->surname,
            'active' => $this->active,
            'email' => $this->email,
            'role' => $this->role
        ]);
    }
}
