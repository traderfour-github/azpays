<?php

namespace App\Jobs\Subscription;

use App\Jobs\SyncJob;
use App\Events\Subscription\StoreEvent;
use App\Events\Subscription\UpdateEvent;
use App\Repositories\Subscription\ISubscriptionRepository;

class UpdateJob extends SyncJob
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
        $subscription = $this->subscriptionRepository->findOneByUser($this->user_id);
        abort_unless($subscription, 403);
        $result = $this->subscriptionRepository->transactional(
            fn() => $this->subscriptionRepository->updateModel($this->subscription, $this->data)
        );

        if ($result) {
            event(new UpdateEvent($result));
            return $result;
        }

        return [];
    }
}
