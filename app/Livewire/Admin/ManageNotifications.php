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
    public $notificationType = "";
    public $editNotification = ['id' => null, 'title'=> null, 'description' => null, 'interval_default' => null, 'interval_before_date' => null];
    #[Layout('layouts.tmcp')]
    public function render()
    {
        $notifications = Notification::orderBy('id')
            ->get();
        return view('livewire.admin.manage-notifications', compact('notifications'));
    }
    public function createNotification()
    {
        // Ensure that notification type is selected
        if (empty($this->notificationType)) {
            // Show error message or handle this case appropriately
            return;
        }

        // Create the notification with the selected type
        Notification::create([
            'title' => $this->title,
            'description' => $this->description,
            'interval_default' => $this->interval,
            'interval_before_date' => $this->notificationType,
        ]);

        // Reset input fields and close modal
        $this->title = '';
        $this->description = '';
        $this->interval = '';
        $this->notificationType = '';
        $this->showNewModal = false;
    }


    public function openEdit(Notification $noti){
        $this->editNotification = [
            'id' => $noti->id,
            'title' => $noti->title,
            'description' => $noti->description,
            'interval_default' => $noti->interval_default,
            'interval_before_date' => $noti->interval_before_date,
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
            'interval_before_date' => trim($this->editNotification['interval_before_date']),
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
