<?php

namespace App\Jobs\Merchant;

use App\Events\Merchant\CreateEvent;
use App\Jobs\SyncJob;
use App\Repositories\Merchants\IMerchantRepository;

class CreateJob extends SyncJob
{
    private IMerchantRepository $merchantRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private mixed $user_id, private array $data)
    {
        $this->merchantRepository = app()->make(IMerchantRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $result = $this->merchantRepository->createMerchant($this->user_id, $this->data);

        if($result){
            event(new CreateEvent($result));
            return $result;
        }

        return [];
    }
}
