<?php

namespace App\Jobs\Merchant;

use App\Events\Merchant\DeleteEvent;
use App\Repositories\Merchants\IMerchantRepository;

class DeleteJob
{
    private IMerchantRepository $merchantRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private mixed $uuid)
    {
        $this->merchantRepository = app()->make(IMerchantRepository::class);
    }

    /**
     * @param MerchantService $merchantService
     * @throws Exception
     */
    public function handle()
    {
        $result = $this->merchantRepository->delete($this->uuid);
        if($result){
            event(new DeleteEvent($result));
            return $result;
        }

        return [];
    }
}
