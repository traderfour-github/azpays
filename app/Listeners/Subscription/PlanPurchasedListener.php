<?php

namespace App\Listeners\Subscription;

use App\Jobs\Subscription\Checks\DoesPlanHaveAffiliateJob;
use App\Jobs\Subscription\Checks\IsSubscriptionInviteOnlyJob;
use App\Jobs\Subscription\Checks\IsSubscriptionPrivateJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlanPurchasedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dispatch(new DoesPlanHaveAffiliateJob($event->subscriptionPurchase));
        dispatch(new IsSubscriptionInviteOnlyJob($event->subscriptionPurchase));
        dispatch(new IsSubscriptionPrivateJob($event->subscriptionPurchase));
    }
}
