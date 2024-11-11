<?php

namespace App\Mail\api\Password;

use App\Models\ResetPasswordCode;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(
        private User $user,
        private ResetPasswordCode $code

    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset password',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.reset_password',
            with: [
                'user' => $this->user,
                'code' => $this->code
            ]
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
