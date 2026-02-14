<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventRegistrationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public readonly Event $event,
        public readonly EventRegistration $registration,
        public readonly bool $isReminder = true, // false = invitation initiale
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjectMessage = $this->isReminder ? 'N\'oubliez pas de finaliser votre inscription' : 'Finalisez votre inscription';
        return new Envelope(
            subject: "{$this->event->type->label()} {$this->event->title} : {$subjectMessage}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.registration-reminder',
            with: [
                'event' => $this->event,
                'registration' => $this->registration,
                'isReminder' => $this->isReminder,
                // Lien à ajuster selon ton flow
                'ctaUrl' => route('events.show', $this->event),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
