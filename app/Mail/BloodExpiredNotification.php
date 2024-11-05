<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BloodExpiredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $expiredBlood;

    /**
     * Create a new message instance.
     */
    public function __construct($expiredBlood)
    {
        $this->expiredBlood = $expiredBlood;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view("Mail.blood_expired")
                    ->with(['expiredBlood' => $this->expiredBlood]);
    }
}
