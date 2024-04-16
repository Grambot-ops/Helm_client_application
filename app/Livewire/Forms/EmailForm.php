<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EmailForm extends Form
{
    #[Validate('required', as: 'subject of the email')]
    public $subject = null;
    #[Validate('required', as: 'message of the email')]
    public $message = null;
}
