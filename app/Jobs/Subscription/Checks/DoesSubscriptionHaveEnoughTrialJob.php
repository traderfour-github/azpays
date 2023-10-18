<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\SubscriptionTrialsAreFinishedEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\Subscription;
use App\Repositories\SubscriptionPurchase\ISubscriptionPurchaseRepository;

class DoesSubscriptionHaveEnoughTrialJob extends SyncJob
{
    private ISubscriptionPurchaseRepository $subscriptionPurchaseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Subscription $subscription,
    ) {
        $this->subscriptionPurchaseRepository = app()->make(ISubscriptionPurchaseRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $totalUsedTrials = $this->subscriptionPurchaseRepository->getTotalUsedTrials($this->subscription->id);

        if ($this->subscription->subscription->max_trials > $totalUsedTrials) {
            return true;
        }

        event(new SubscriptionTrialsAreFinishedEvent($this->subscription));

        return false;
    }
}
