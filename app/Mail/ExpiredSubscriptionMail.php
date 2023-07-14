<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiredSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subscription;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        from subscription relations we can get user name , application name and platform
        return $this->view('emails.expired_subscription')
            ->subject('Your subscription has expired');
    }
}
