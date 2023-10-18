<?php

namespace App\Jobs\Merchant;

use App\Jobs\SyncJob;
use App\Repositories\Merchants\IMerchantRepository;

class GetJob extends SyncJob
{
    private IMerchantRepository $merchantRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $data, private mixed $user_id)
    {
        $this->merchantRepository = app()->make(IMerchantRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->merchantRepository->get($this->user_id, $this->data);
    }
}
