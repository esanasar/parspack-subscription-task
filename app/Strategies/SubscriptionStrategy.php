<?php

namespace App\Strategies;

use App\Models\Subscription;

interface SubscriptionStrategy
{
    public function checkSubscriptionStatus(Subscription $subscription): array;
}
