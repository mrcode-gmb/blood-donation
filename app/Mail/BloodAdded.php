<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BloodAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $bloodType, $quantity, $addedDate, $expirationDate;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $bloodType, $quantity, $addedDate, $expirationDate)
    {
        //
        $this->user = $user;
        $this->bloodType = $bloodType;
        $this->quantity = $quantity;
        $this->addedDate = $addedDate;
        $this->expirationDate = $expirationDate;
    }

    public function build()
    {
        return $this->view("Mail.blood_added")->subject("Blood Donor")->with([
            "user" => $this->user,
            "bloodType" => $this->bloodType,
            "quantity" => $this->quantity,
            "addedDate" => $this->addedDate,
            "expirationDate" => $this->expirationDate,
        ]);
    }

}
