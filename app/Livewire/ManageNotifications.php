<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageNotifications extends Component
{
    public $showModal = false;
    public $showModalEdit = false;
    #[Layout('layouts.tmcp')]
    public function render()
    {
        $notifications = Notification::orderBy('id')
            ->get();
        return view('livewire.manage-notifications',compact('notifications'));
    }

    public $editNotification = ['id' => null, 'description' => null, 'intervalDefault' => null];
    public function openEdit(Notification $noti){
        $this->editNotification = [
            'id' => $noti->id,
            'description' => $noti->description,
            'interval_default' => $noti->interval_default,
        ];

        $this->showModalEdit = true;
    }

    public function closeEdit(){
        $this->showModalEdit = false;
    }
    public function editNoti(Notification $noti){

        $this->editNotification['description'] = trim($this->editNotification['description']);
        $this->editNotification['interval_default'] = trim($this->editNotification['interval_default']);


        $noti->update([
            'description' => trim($this->editNotification['description']),
            'interval_default' => trim($this->editNotification['interval_default']),
        ]);


    }
}
