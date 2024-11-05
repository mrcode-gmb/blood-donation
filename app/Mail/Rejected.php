<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Rejected extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view("Mail.rejected")
                    ->subject("blood Donor")
                    ->with([
                        "user"=>$this->user
                    ]);
    }
}
