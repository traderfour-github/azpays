<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\PlanReachedToProfitLimitEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPurchase;

class DoesPlanReachedToProfitLimitJob extends SyncJob
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private SubscriptionPurchase $subscriptionPurchase,
        private int $profit
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ($this->subscriptionPurchase->subscriptionPlan->maximum_profit > $this->profit) {
            return false;
        }

        event(new PlanReachedToProfitLimitEvent($this->subscriptionPurchase));

        return true;
    }
}
