<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\SubscriptionCapacityIsFullEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\Subscription;
use App\Repositories\SubscriptionPurchase\ISubscriptionPurchaseRepository;

class DoesSubscriptionHaveEnoughCapacityJob extends SyncJob
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
        $totalSubscribers = $this->subscriptionPurchaseRepository->getTotalSubscribers($this->subscription->id);

        if ($this->subscription->max_capacity > $totalSubscribers) {
            return true;
        }

        event(new SubscriptionCapacityIsFullEvent($this->subscription));

        return false;
    }
}
