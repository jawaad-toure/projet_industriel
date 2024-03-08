<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmUpdateEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $userId;
    protected $userNewEmail;
    /**
     * Create a new message instance.
     */
    public function __construct(int $userId, string $userNewEmail)
    {
        $this->userId = $userId;
        $this->userNewEmail = $userNewEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Validation d'adresse email",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.update_email_validation_content',
            with: ["emailValidationUserId" => $this->userId, "emailValidationUserNewEmail" => $this->userNewEmail],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
