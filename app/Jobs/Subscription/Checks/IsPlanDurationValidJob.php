<?php

namespace App\Jobs\Subscription\Checks;

use App\Events\Subscription\Checks\PlanDurationIsPassedEvent;
use App\Jobs\SyncJob;
use App\Models\Subscription\SubscriptionPurchase;
use Carbon\Carbon;

class IsPlanDurationValidJob extends SyncJob
{
    /**
     * Create a new job instance.
     */
    public function __construct(
        private SubscriptionPurchase $subscriptionPurchase,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (! Carbon::make($this->subscriptionPurchase->started_at)
            ->addDays($this->subscriptionPurchase->subscriptionPlan->duration)->isPast()
        ) {
            return true;
        }

        event(new PlanDurationIsPassedEvent($this->subscriptionPurchase));

        return false;
    }
}
