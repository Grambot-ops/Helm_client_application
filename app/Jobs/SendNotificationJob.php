<?php

namespace App\Jobs;

use App\Mail\NotificationMail;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $competition;
    protected $notification;

    /**
     * Create a new job instance.
     *
     * @param Competition $competition
     * @param array $notification
     */
    public function __construct(Competition $competition, array $notification)
    {
        $this->competition = $competition;
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $users = User::where('is_subscribed', true)->get(); // adjust the query to get relevant users

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationMail([
                'subject' => $this->notification['title'],
                'message' => $this->notification['description'],
                'competition' => $this->competition->title,
                'date' => $this->competition->date
            ]));
        }
    }
}
