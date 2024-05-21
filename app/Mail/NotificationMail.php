<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class npNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('notifications@tmcplatform.be', 'TMC Platform'),
            subject: $this->details['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notification-sent',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

