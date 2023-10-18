<?php

namespace App\Jobs\Subscription;

use App\Jobs\SyncJob;
use App\Repositories\Subscription\ISubscriptionRepository;

class ShowJob extends SyncJob
{
    private ISubscriptionRepository $subscriptionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id, private $subscription)
    {
        $this->subscriptionRepository = app()->make(ISubscriptionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $result = $this->subscriptionRepository->findOneByUser($this->user_id, $this->subscription);
        abort_unless($result, 403);
        return $result;
    }
}
