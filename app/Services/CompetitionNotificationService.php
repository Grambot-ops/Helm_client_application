<?php
namespace App\Services;

use App\Mail\CompetitionNotificationMail;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CompetitionNotificationService
{
    public function sendNotifications()
    {
        // Logic to fetch competitions and send notifications
        $competitions = Competition::all();

        foreach ($competitions as $competition) {
            // Logic to determine if notification should be sent based on start_date and interval_before_date
            // Retrieve users for this competition
            $users = $competition->participations()->pluck('user_id');

            foreach ($users as $userId) {
                // Send notification to each user
                $user = User::find($userId);
                $this->sendNotificationToUser($user, $competition);
            }
        }
    }

    private function sendNotificationToUser(User $user, Competition $competition)
    {
        // Use Laravel's Mail facade to send notification emails
        // You need to define your email template and pass relevant data here
        // For example:
        Mail::to($user->email)->send(new CompetitionNotificationMail($user, $competition));
    }
}
