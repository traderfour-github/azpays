<?php

namespace App\Repositories\Subscription;

use App\Enums\Subscription\SubscriptionStatusEnum;
use App\Models\Subscription\Subscription;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionRepository extends AbstractRepository implements ISubscriptionRepository
{
    protected function instance(array $attributes = []): Model
    {
        return new Subscription();
    }

    public function getActiveSubscriptions($subscriptionId): Collection
    {
        return $this->model->when(! empty($subscriptionId), function (Builder $builder) use ($subscriptionId) {
                $builder->where('id', $subscriptionId);
            })
            ->where('status', SubscriptionStatusEnum::Active->value)
            ->with([
                'subscriptionPlans',
                'subscriptionPurchases' => function(HasMany $query) {
                    $query->whereNull('cancel_at')->whereNull('expired_at');
                },
            ])
            ->get();
    }
}
