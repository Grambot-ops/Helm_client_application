<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageNotifications extends Component
{
    #[Layout('layouts.tmcp')]
    public function render()
    {
        $notifications = Notification::orderBy('description')
            ->get();
        return view('livewire.manage-notifications',compact('notifications'));
    }
}
