<?php

namespace App\Mail;

use App\Models\Competition;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompetitionNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $competition;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Competition $competition
     */
    public function __construct($user, $competition)
    {
        $this->user = $user;
        $this->competition = $competition;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(new Address('notifications@tmcplatform.be', 'TMC Platform'))
            ->subject('New Competition Notification')
            ->view('emails.competition_notification')
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()
                    ->addTextHeader('subject', 'New Competition Notification')
                    ->addTextHeader('X-Mailgun-Tag', 'competition_notification');
            });
    }
}
