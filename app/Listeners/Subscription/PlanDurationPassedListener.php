<?php

namespace App\Listeners\Subscription;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlanDurationPassedListener
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
        // todo: If it's set to be renewed and user purse has enough balance then renew the plan. Else expire the plan.
    }
}
