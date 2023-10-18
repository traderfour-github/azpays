<?php

namespace App\Jobs\Subscription\Checks;

use App\Jobs\SyncJob;
use App\Models\Subscription\Subscription;

class CheckSubscriptionJob extends SyncJob
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private Subscription $subscription,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        dispatch(new DoesSubscriptionHaveEnoughCapacityJob($this->subscription));
        dispatch(new DoesSubscriptionHaveEnoughTrialJob($this->subscription));

        foreach ($this->subscription->subscriptionPlans as $subscriptionPlan) {
            dispatch(new DoesPlanHaveEnoughCapacityJob($subscriptionPlan));
            dispatch(new DoesPlanHaveEnoughTrialJob($subscriptionPlan));
        }

        foreach ($this->subscription->subscriptionPurchases as $subscriptionPurchase) {
            dispatch(new IsPlanDurationValidJob($subscriptionPurchase));
        }
    }
}
