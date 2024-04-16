<?php

namespace App\Livewire\Organiser;

use App\Livewire\Forms\EmailForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SendAnnouncement extends Component
{
    protected $rules = [
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];
    public EmailForm $form;

    #[Layout('layouts.tmcp', ['title' => 'Announcement', 'description' => 'Send an announcement',])]
    public function render()
    {
        $this->form->reset();
        return view('livewire.organiser.send-announcement');
    }

    public function submit()
    {
        $this->validate();

    }
}
