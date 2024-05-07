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

    public $showNewModal = false;
    public $title = "";
    public $description = "";
    public $interval = "";
    #[Layout('layouts.tmcp')]
    public function render()
    {
        $notifications = Notification::orderBy('id')
            ->get();
        return view('livewire.admin.manage-notifications', compact('notifications'));
    }

    public function createNotification(){
        Notification::create([
            'title' => $this->title,
            'description' => $this->description,
            'interval_default' => $this->interval
        ]);

        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The type <b><i>{$this->title}</i></b> has been added",
            'icon' => 'success',
        ]);

        $this->showNewModal = false;
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
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The notifictation has been updated",
        ]);
        $this->showModalEdit = false;
    }

    public function deleteNoti(Notification $noti){
        $noti->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The notifictation has been deleted",
        ]);
    }

}
