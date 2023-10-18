<?php

namespace App\Jobs\Subscription;

use App\Jobs\SyncJob;
use App\Events\Subscription\DeleteEvent;
use App\Repositories\Subscription\ISubscriptionRepository;

class DeleteJob extends SyncJob
{
    private ISubscriptionRepository $subscriptionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id, private $subscription, private array $data) {
        $this->subscriptionRepository = app()->make(ISubscriptionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $result = $this->subscriptionRepository->delete($this->subscription);
        if ($result) {
            event(new DeleteEvent($result));
            return $result;
        }

        return [];
    }
}
