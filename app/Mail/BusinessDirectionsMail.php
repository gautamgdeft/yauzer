<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessDirectionsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $business;
    public $businessDirectionLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($business, $businessDirectionLink)
    {
        $this->business = $business;
        $this->businessDirectionLink = $businessDirectionLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.emails.business_directions');
    }
}
