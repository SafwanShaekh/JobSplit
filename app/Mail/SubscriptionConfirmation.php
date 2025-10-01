<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        // Is email mein humein koi data pass karne ki zaroorat nahi hai
    }

    /**
     * Get the message envelope.
     * Yahan hum email ka subject set karte hain.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscription Confirmation - JobSplit',
        );
    }

    /**
     * Get the message content definition.
     * Yahan hum batate hain ke email ki body ke liye konsi view file istemal karni hai.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription_confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return []; // Is email mein koi attachments nahi hain
    }
}