<?php

namespace App\Http\Controllers\V1\User\Subscription;

use App\Http\Requests\Subscription\SubscriptionWebhookRequest;
use App\Http\Controllers\Controller;
use App\Jobs\Subscription\SubscriptionWebhookJob;

class WebhookController extends Controller
{
    public function info(SubscriptionWebhookRequest $request)
    {
        dispatch_sync(new SubscriptionWebhookJob($request->validated()));
    }
}
