<?php

namespace App\Repositories\SubscriptionPlan;

use App\Models\Subscription\SubscriptionPlan;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanRepository extends AbstractRepository implements ISubscriptionPlanRepository
{
    protected function instance(array $attributes = []): Model
    {
        return new SubscriptionPlan();
    }
}
