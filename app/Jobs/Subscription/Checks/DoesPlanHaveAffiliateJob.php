<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\PlanHasAffiliateEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPurchase;
use App\Repositories\Subscription\ISubscriptionRepository;

class DoesPlanHaveAffiliateJob extends SyncJob
{
    private ISubscriptionRepository $subscriptionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private SubscriptionPurchase $subscriptionPurchase,
    ) {
        $this->subscriptionRepository = app()->make(ISubscriptionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ($this->subscriptionPurchase->subscriptionPlan->affiliate) {
            event(new PlanHasAffiliateEvent($this->subscriptionPurchase));

            return true;
        }

        return false;
    }
}
