<?php

namespace App\Jobs\Subscription;

use App\Jobs\SyncJob;
use App\Events\Subscription\StoreEvent;
use App\Enums\Subscription\SubscriptionStatusEnum;
use App\Repositories\Subscription\ISubscriptionRepository;

class StoreJob extends SyncJob
{
    private ISubscriptionRepository $subscriptionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $user_id,
        private array $data,
    ) {
        $this->subscriptionRepository = app()->make(ISubscriptionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->data['user_id'] = $this->user_id;
        $this->data['status'] = SubscriptionStatusEnum::Active;

        $result = $this->subscriptionRepository->transactional(
            fn () => $this->subscriptionRepository->create($this->data)
        );

        if ($result) {
            event(new StoreEvent($result));
            return $result;
        }

        return [];
    }
}
