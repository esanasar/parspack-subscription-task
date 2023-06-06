<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionLog;
use Illuminate\Http\Request;

class SubscriptionLogController extends Controller
{
    function expiredSubscriptionCount ()
    {
        $subscriptionLog = SubscriptionLog::latest('created_at')->first();

        $data = [
            'count' => $subscriptionLog->count
        ];

        $this->success($data);
    }
}
