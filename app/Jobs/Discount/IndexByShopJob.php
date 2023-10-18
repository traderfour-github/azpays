<?php

namespace App\Jobs\Discount;

use App\Jobs\SyncJob;
use App\Repositories\Discount\IDiscountRepository;

class IndexByShopJob extends SyncJob
{
    private IDiscountRepository $discountRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $shop_id)
    {
        $this->discountRepository = app()->make(IDiscountRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->discountRepository->getByUser($this->shop_id);
    }
}
