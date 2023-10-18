<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\PlanHasCharityShareEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPurchase;

class DoesPlanHaveCharityShareJob extends SyncJob
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
        if ($this->subscriptionPurchase->subscriptionPlan->charity_share > 0) {
            event(new PlanHasCharityShareEvent($this->subscriptionPurchase));

            return true;
        }

        return false;
    }
}
