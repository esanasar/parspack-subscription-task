<?php

namespace App\Jobs;

use App\Mail\ExpiredSubscriptionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendExpiredSubscriptionMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $subscription;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->queue = 'expiredSubscriptionMail';
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('admin-email@mail.com')->send(new ExpiredSubscriptionMail($this->subscription));

    }
}
