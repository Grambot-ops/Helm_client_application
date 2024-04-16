<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageNotifications extends Component
{
    public $showModal = false;
    public $showModalEdit = false;
    public $editNotificationId;

    #[Layout('layouts.tmcp')]
    public function render()
    {
        $notifications = Notification::orderBy('id')
            ->get();
        return view('livewire.admin.manage-notifications', compact('notifications'));
    }

    public $editNotification = ['id' => null, 'title'=> null, 'description' => null, 'intervalDefault' => null];
    public function openEdit(Notification $noti){
        $this->editNotification = [
            'id' => $noti->id,
            'title' => $noti->title,
            'description' => $noti->description,
            'interval_default' => $noti->interval_default,
        ];

        $this->editNotificationId = $noti->id;
        $this->showModalEdit = true;
    }



    public function closeEdit(){
        $this->showModalEdit = false;
    }
    public function editNoti(){
        $notification = Notification::findOrFail($this->editNotificationId);
        $notification->update([
            'title' => trim($this->editNotification['title']),
            'description' => trim($this->editNotification['description']),
            'interval_default' => trim($this->editNotification['interval_default']),
        ]);

        $this->showModalEdit = false;
    }

}
