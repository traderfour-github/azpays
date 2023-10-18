<?php

namespace App\Jobs\Discount;

use App\Jobs\SyncJob;
use App\Repositories\Discount\IDiscountRepository;
use function App\Jobs\Transaction\app;

class DestroyJob extends SyncJob
{
    private IDiscountRepository $discountRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $user_id, private $discount)
    {
        $this->discountRepository = app()->make(IDiscountRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $discountItem = $this->discountRepository->findOneByUser($this->user_id, $this->discount);

        if (!$discountItem) {
            return $this->respondForbidden();
        }

        $discountItem->delete();

        return $this->respondEntityRemoved($this->discount);
    }
}
