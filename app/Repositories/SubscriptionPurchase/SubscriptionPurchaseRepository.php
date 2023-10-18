<?php

namespace App\Repositories\SubscriptionPurchase;

use App\Models\Subscription\SubscriptionPurchase;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPurchaseRepository extends AbstractRepository implements ISubscriptionPurchaseRepository
{
    protected function instance(array $attributes = []): Model
    {
        return new SubscriptionPurchase();
    }

    public function getTotalUsedTrials(string $subscriptionId): int
    {
        return $this->model
            ->where('subscription_id', $subscriptionId)
            ->where('is_trial', true)
            ->count();
    }

    public function getPlanUsedTrials(string $subscriptionPlanId): int
    {
        return $this->model
            ->where('subscription_plan_id', $subscriptionPlanId)
            ->where('is_trial', true)
            ->count();
    }

    public function getTotalSubscribers(string $subscriptionId): int
    {
        return $this->model
            ->where('subscription_id', $subscriptionId)
            ->where('is_trial', false)
            ->count();
    }

    public function getPlanSubscribers(string $subscriptionPlanId): int
    {
        return $this->model
            ->where('subscription_plan_id', $subscriptionPlanId)
            ->where('is_trial', false)
            ->count();
    }
}
