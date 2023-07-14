<?php

namespace App\Services;

use App\Models\Subscription;
use App\Strategies\SubscriptionStrategy;

class SubscriptionService
{
    protected $subscriptionStrategy;

    public function __construct(SubscriptionStrategy $subscriptionStrategy)
    {
        $this->subscriptionStrategy = $subscriptionStrategy;
    }

    public function checkAndSyncSubscriptionStatus(Subscription $subscription)
    {
        // Call the strategy's checkSubscriptionStatus method
        $newStatus = $this->subscriptionStrategy->checkSubscriptionStatus($subscription);

        // Update the subscription status in your data storage or perform any necessary actions

        return $newStatus;
    }

    // Other methods and business logic for the subscription synchronization service
    // ...
}
