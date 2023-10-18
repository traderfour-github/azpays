<?php

namespace App\Jobs\Subscription;

use App\Jobs\SyncJob;
use App\Repositories\Subscription\ISubscriptionRepository;

class IndexJob extends SyncJob
{
    private ISubscriptionRepository $subscriptionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id,)
    {
        $this->subscriptionRepository = app()->make(ISubscriptionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->subscriptionRepository->getByUser($this->user_id);
    }
}
