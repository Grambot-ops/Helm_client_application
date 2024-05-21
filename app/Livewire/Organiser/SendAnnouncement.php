<?php

namespace App\Livewire\Organiser;

use App\Livewire\Forms\EmailForm;
use App\Mail\Announcement;
use App\Models\Competition;
use App\Models\Participation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mail;

class SendAnnouncement extends Component
{
    protected $rules = [
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'competitionId' => 'required|exists:competitions,id',
    ];
    public EmailForm $form;

    #[Layout('layouts.tmcp', ['title' => 'Announcement', 'description' => 'Send an announcement','page_author' => 'Stef'])]
    public function render()
    {
        $this->form->reset();
        $participations = Participation::with(['submissions', 'user'])
            ->get();
        $competitions = Competition::where('user_id', auth()->id())
            ->get();
        return view('livewire.organiser.send-announcement', compact('participations', 'competitions'));
    }

    public function submit()
    {
        $this->form->validate();
        $participations = Participation::where('competition_id', $this->form->competitionId)
            ->with(['submissions', 'user'])
            ->get();
        $details = [
            'subject' => $this->form->subject,
            'message' => $this->form->message,
        ];
        foreach ($participations as $participation) {
            Mail::to($participation->user->email)->send(new Announcement($details));
        }
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The email has succefully been sent to all participants of the competition",
            'icon' => 'success',
        ]);
        return back()->with('message', 'Email sent successfully');
    }
}
