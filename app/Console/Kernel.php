<?php

namespace App\Console;

use App\Jobs\SendNotificationJob;
use App\Models\Competition;
use App\Models\Notification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $notifications = Notification::all();

            foreach ($notifications as $notification) {
                $competitions = Competition::whereDate('date', '>=', now()->addDays($notification->interval_default))->get();

                foreach ($competitions as $competition) {
                    $sendDate = $competition->date->subDays($notification->interval_default);
                    if ($sendDate->isFuture()) {
                        SendNotificationJob::dispatch($competition, $notification->toArray())->delay($sendDate);
                    }
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
