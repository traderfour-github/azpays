<?php

namespace App\Console\Commands;

use App\Jobs\Subscription\Checks\CheckSubscriptionJob;
use App\Repositories\Subscription\ISubscriptionRepository;
use Illuminate\Console\Command;

class CheckSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:check {--id=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs subscription checks.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $subscriptionRepository = app()->make(ISubscriptionRepository::class);

        $subscriptions = $subscriptionRepository->getActiveSubscriptions($this->option('id'));

        foreach ($subscriptions as $subscription) {
            dispatch(new CheckSubscriptionJob($subscription));
        }
    }
}
