<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token; // Add this line

    /**
     * Create a new message instance.
     */
    public function __construct($token) // Modify this line
    {
        $this->token = $token; // Add this line
    }

    public function build(): VerificationEmail
    {
        return $this->view('emails.verification')
            ->with([
                'token' => $this->token,
            ]);
    }

    // ... rest of your code
}
