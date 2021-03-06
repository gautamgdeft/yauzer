<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PremiumBusinessOwnerEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $business;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($business)
    {
        $this->business = $business;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.premium_business_owner_notification');
    }
}
