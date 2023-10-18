<?php

namespace App\Jobs\Subscription;

use App\Jobs\Subscription\Checks\DoesPlanReachedToAccountsLimitJob;
use App\Jobs\Subscription\Checks\DoesPlanReachedToProfitLimitJob;
use App\Jobs\SyncJob;
use App\Repositories\SubscriptionPurchase\ISubscriptionPurchaseRepository;

class SubscriptionWebhookJob extends SyncJob
{
    private ISubscriptionPurchaseRepository $subscriptionPurchaseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private array $data,
    ) {
        $this->subscriptionPurchaseRepository = app()->make(ISubscriptionPurchaseRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $subscriptionPurchase = $this->subscriptionPurchaseRepository->find($this->data['subscription_purchase_id']);

        dispatch(new DoesPlanReachedToAccountsLimitJob($subscriptionPurchase, $this->data['accounts']));
        dispatch(new DoesPlanReachedToProfitLimitJob($subscriptionPurchase, $this->data['profit']));
    }
}
