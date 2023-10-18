<?php

namespace App\Jobs\Merchant;

use App\Events\Merchant\UpdateEvent;
use App\Repositories\Merchants\IMerchantRepository;

class UpdateJob
{
    private IMerchantRepository $merchantRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private mixed $user_id, private string $merchant_id, private array $data)
    {
        $this->merchantRepository = app()->make(IMerchantRepository::class);
    }


    /**
     * @param MerchantService $merchantService
     * @throws Exception
     */
    public function handle()
    {
        if(isset($data['logo']) && $data['logo'])
            $data['logo'] = dispatch_sync(new UploadJob($data['logo']));
        $result = $this->merchantRepository->update($this->user_id, $this->merchant_id, $this->data);

        if($result){
            event(new UpdateEvent($result));
            return $result;
        }

        return [];
    }
}
