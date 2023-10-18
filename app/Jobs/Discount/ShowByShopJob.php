<?php

namespace App\Jobs\Discount;

use App\Jobs\SyncJob;
use App\Repositories\Discount\IDiscountRepository;

class ShowByShopJob extends SyncJob
{
    private IDiscountRepository $discountRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $user_id, private int $discount)
    {
        $this->discountRepository = app()->make(IDiscountRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->discountRepository->findOneByUser($this->user_id, $this->discount);
    }
}
