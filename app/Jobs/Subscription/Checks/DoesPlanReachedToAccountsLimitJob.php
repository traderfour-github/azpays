<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\PlanReachedToAccountsLimitEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPurchase;
use App\Repositories\SubscriptionPurchase\ISubscriptionPurchaseRepository;

class DoesPlanReachedToAccountsLimitJob extends SyncJob
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private SubscriptionPurchase $subscriptionPurchase,
        private int $accounts
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ($this->subscriptionPurchase->subscriptionPlan->maximum_accounts > $this->accounts) {
            return false;
        }

        event(new PlanReachedToAccountsLimitEvent($this->subscriptionPurchase));

        return true;
    }
}
