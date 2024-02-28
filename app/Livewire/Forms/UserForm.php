<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public $id = null;
    #[Validate('required', as: 'name of the user')]
    public $name = null;
    #[Validate('required|email', as: 'email for this user')]
    public $email = null;
    #[Validate('required|bool', as: 'is this user active?')]
    public $active = null;
}
