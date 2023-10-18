<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\SubscriptionIsInviteOnlyEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPurchase;

class IsSubscriptionInviteOnlyJob extends SyncJob
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
        if ($this->subscriptionPurchase->subscription->invite_only) {
            event(new SubscriptionIsInviteOnlyEvent($this->subscriptionPurchase));

            return true;
        }

        return false;
    }
}
