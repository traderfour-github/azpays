<?php

namespace App\Repositories\SubscriptionPurchase;

interface ISubscriptionPurchaseRepository
{
    public function getTotalUsedTrials(string $subscriptionId): int;
    public function getPlanUsedTrials(string $subscriptionPlanId): int;
    public function getTotalSubscribers(string $subscriptionId): int;
    public function getPlanSubscribers(string $subscriptionPlanId): int;
}
