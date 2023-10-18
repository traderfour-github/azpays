<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\SubscriptionIsPrivateEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPurchase;

class IsSubscriptionPrivateJob extends SyncJob
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private SubscriptionPurchase $subscriptionPurchase,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ($this->subscriptionPurchase->subscription->private) {
            event(new SubscriptionIsPrivateEvent($this->subscriptionPurchase));

            return true;
        }

        return false;
    }
}
