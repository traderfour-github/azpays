<?php

namespace App\Repositories\Subscription;

use Illuminate\Database\Eloquent\Collection;

interface ISubscriptionRepository
{
    public function getActiveSubscriptions($subscriptionId): Collection;
}
