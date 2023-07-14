<?php
namespace App\Strategies;

use App\Models\Subscription;
use App\Strategies\SubscriptionStrategy;
use Illuminate\Support\Facades\Http;

class IosSubscription implements SubscriptionStrategy
{
    public function checkSubscriptionStatus(Subscription $subscription) :array
    {

        $data = [
            'receipt-data' => 'receipt-data',
//            receipt data is a base64-encoded data which contains information about the user's purchase history
        ];
        $response = Http::post("https://buy.itunes.apple.com/verifyReceipt", $data);

        return [
            'response' => $response
        ];

    }
}