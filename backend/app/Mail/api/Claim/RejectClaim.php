<?php

namespace App\Mail\api\Claim;

use App\Models\Claim;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectClaim extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private User $user,
        private Claim $claim
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ответ на заявку',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.reject_claim',
            with: [
                'user' => $this->user,
                'claim' => $this->claim
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
