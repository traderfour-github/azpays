<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\PlanCapacityIsFullEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPlan;
use App\Repositories\SubscriptionPurchase\ISubscriptionPurchaseRepository;

class DoesPlanHaveEnoughCapacityJob extends SyncJob
{
    private ISubscriptionPurchaseRepository $subscriptionPurchaseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private SubscriptionPlan $subscriptionPlan,
    ) {
        $this->subscriptionPurchaseRepository = app()->make(ISubscriptionPurchaseRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $planSubscribers = $this->subscriptionPurchaseRepository->getPlanSubscribers($this->subscriptionPlan->id);

        if ($this->subscriptionPlan->capacity > $planSubscribers) {
            return true;
        }

        event(new PlanCapacityIsFullEvent($this->subscriptionPlan));

        return false;
    }
}
