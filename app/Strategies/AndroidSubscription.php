<?php
namespace App\Strategies;

use App\Models\Subscription;
use App\Strategies\SubscriptionStrategy;
use Illuminate\Support\Facades\Http;

class AndroidSubscription implements SubscriptionStrategy
{
    public function checkSubscriptionStatus(Subscription $subscription) :array
    {
        $applicationName = $subscription->application->name;
        $subscriptionId = $subscription->id;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer {your-access-token}',
            'Accept' => 'application/json'
        ])->get("https://www.googleapis.com/androidpublisher/v3/applications/$applicationName/purchases/subscriptions/$subscriptionId");


        return [
            'response' => $response
        ];
    }
}