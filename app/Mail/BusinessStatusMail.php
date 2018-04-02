<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $businessListing;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($businessListing)
    {
        $this->businessListing = $businessListing;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.emails.business_status');
    }
}
