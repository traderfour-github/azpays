<?php

namespace App\Providers;

use App\Events\Payment\PaymentVerifiedEvent;
use App\Events\Subscription\Checks\PlanDurationIsPassedEvent;
use App\Events\Subscription\Checks\PlanHasCharityShareEvent;
use App\Events\Subscription\Checks\PlanReachedToAccountsLimitEvent;
use App\Events\Subscription\Checks\PlanReachedToProfitLimitEvent;
use App\Events\Subscription\Plan\PlanPurchasedEvent;
use App\Listeners\Payment\PaymentVerificationListener;
use App\Listeners\Subscription\PlanPurchasedListener;
use App\Listeners\Subscription\PlanDurationPassedListener;
use App\Listeners\Subscription\PlanHasCharityShareListener;
use App\Listeners\Subscription\PlanReachedToAccountsLimitListener;
use App\Listeners\Subscription\PlanReachedToProfitLimitListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PaymentVerifiedEvent::class => [
            PaymentVerificationListener::class,
        ],
        PlanPurchasedEvent::class => [
            PlanPurchasedListener::class,
        ],
        PlanDurationIsPassedEvent::class => [
            PlanDurationPassedListener::class,
        ],
        PlanHasCharityShareEvent::class => [
            PlanHasCharityShareListener::class,
        ],
        PlanReachedToAccountsLimitEvent::class => [
            PlanReachedToAccountsLimitListener::class,
        ],
        PlanReachedToProfitLimitEvent::class => [
            PlanReachedToProfitLimitListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
