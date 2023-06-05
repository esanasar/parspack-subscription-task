<?php

namespace App\Console\Commands;

use App\Jobs\SendExpiredSubscriptionMail;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SubscriptionService;
use App\Strategies\AndroidSubscription;
use App\Strategies\IosSubscription;
use Illuminate\Console\Command;

class CheckSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks the subscription of every application that user has on his/her platform';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription){
            $platform = $subscription->platform->name;

            if ($platform === 'android') {
                $strategy = new AndroidSubscription();
                $retryInterval = 60*60;
            } elseif ($platform === 'ios') {
                $strategy = new IosSubscription();
                $retryInterval = 120*60;
            } else {
                // Handle unsupported platform case
                throw new \InvalidArgumentException('Unsupported platform');
            }

            $subscriptionService = new SubscriptionService($strategy);
            $result = $subscriptionService->checkAndSyncSubscriptionStatus($subscription);
            $response = $result['response'];
            if ($response->getStatusCode() != 200 ) {
                sleep($retryInterval);
                $this->call(static::class);
            }else{
                $responseData = json_decode($response->getBody(), true);

                if ($platform === 'android') {
                    $status = $responseData['status'];
                } elseif ($platform === 'ios') {
                    $status = $responseData['latest_receipt_info'][0]['subscription_status'];
                }

                if ($subscription->status === 'active' && $status === 'expired') {
                    dispatch(new SendExpiredSubscriptionMail($subscription));
//                from subscription relations we can get user name , application name and platform
                }

                $subscription->status = $status;
                $subscription->save();
            }
        }
    }
}
