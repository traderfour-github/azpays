<?php

namespace App\Jobs\Merchant;

use App\Jobs\SyncJob;
use App\Repositories\Merchants\IMerchantRepository;

class ReadJob extends SyncJob
{
    private IMerchantRepository $merchantRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $user_id, private string $merchant_id)
    {
        $this->merchantRepository = app()->make(IMerchantRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->merchantRepository->read($this->user_id, $this->merchant_id);
    }
}
