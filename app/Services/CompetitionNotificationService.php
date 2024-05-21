<?php

namespace App\Services;

use App\Mail\CompetitionNotificationMail;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CompetitionNotificationService
{
    public function sendNotifications()
    {
        // Fetch all competitions
        $competitions = Competition::all();
        Log::info('Fetched competitions', ['count' => $competitions->count()]);

        foreach ($competitions as $competition) {
            // Check if we should send notifications for this competition
            $notifications = $competition->notifications; // Assuming notifications are related to competition

            // Ensure notifications exist before proceeding
            if ($notifications) {
                foreach ($notifications as $notification) {
                    $shouldSend = $this->shouldSendNotification($competition, $notification);

                    if ($shouldSend) {
                        // Retrieve users for this competition
                        $users = $competition->participations()->pluck('user_id');
                        Log::info('Users for competition', ['competition_id' => $competition->id, 'user_count' => $users->count()]);

                        foreach ($users as $userId) {
                            // Send notification to each user
                            $user = User::find($userId);
                            if ($user) {
                                $this->sendNotificationToUser($user, $competition);
                            }
                        }
                    }
                }
            } else {
                Log::info('No notifications found for competition', ['competition_id' => $competition->id]);
            }
        }
    }


    private function shouldSendNotification($competition, $notification)
    {
        switch ($notification->interval_before_date) {
            case 'begin':
                $eventDate = $competition->start_date;
                break;
            case 'submission':
                $eventDate = $competition->submission_deadline;
                break;
            case 'end':
                $eventDate = $competition->end_date;
                break;
            default:
                return false;
        }


        $notificationDate = Carbon::parse($eventDate)->subDays($notification->interval_default);

        return Carbon::now()->isSameDay($notificationDate);
    }

    private function sendNotificationToUser(User $user, Competition $competition)
    {
        Mail::to($user->email)->send(new CompetitionNotificationMail($user, $competition));
    }
}
