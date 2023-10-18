<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\PlanTrialsAreFinishedEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPlan;
use App\Repositories\SubscriptionPurchase\ISubscriptionPurchaseRepository;

class DoesPlanHaveEnoughTrialJob extends SyncJob
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
        $planUsedTrials = $this->subscriptionPurchaseRepository->getPlanUsedTrials($this->subscriptionPlan->id);

        if ($this->subscriptionPlan->trials > $planUsedTrials) {
            return true;
        }

        event(new PlanTrialsAreFinishedEvent($this->subscriptionPlan));

        return false;
    }
}
