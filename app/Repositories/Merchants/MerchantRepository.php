<?php

namespace App\Repositories\Merchants;

use EloquentBuilder;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantPurse;
use App\Repositories\Contracts\AbstractRepository;

class MerchantRepository extends AbstractRepository implements IMerchantRepository
{
    protected $model = Merchant::class;

    public function get(mixed $user_id ,array $data)
    {
        if(empty($data)){
            return $this->getModel()->whereHas('merchantUser',function ($userQuery)use($user_id){
                return $userQuery->where('user_id',$user_id);
            })->get();
        }else{

            return $transactionRow = EloquentBuilder::to($this->model, $data)
            ->whereHas('merchantUser',function ($userQuery)use($user_id){
                return $userQuery->where('user_id',$user_id);
            })->get();
        }
    }

    public function read(mixed $user_id, string $merchant_id){
        return $this->getModel()->whereHas('merchantUser',function ($userQuery)use($user_id){
            return $userQuery->where('user_id',$user_id);
        })->where('id',$merchant_id)->firstOrFail();
    }

    public function createMerchant(mixed $user_id, array $data)
    {
        $merchant = $this->create($data);
        $this->createMerchantPurse($merchant, $data['purses'], $user_id);
        $this->syncTags($merchant, $data);
        $this->syncCategories($merchant, $data);
        $merchant->refresh();

        return $merchant;
    }

    public function update(mixed $user_id, string $merchant_id, array $data){
        $merchant = $this->getModel()->find($merchant_id);
        $merchant->update($data);
        $this->updateMerchantPurse($merchant, $data['purses'], $user_id);
        $this->syncTags($merchant, $data);
        $this->syncCategories($merchant, $data);
        $merchant->refresh();

        return $merchant;
    }

    public function delete(string $merchant_id){
        $this->getModel()->find($merchant_id)->delete();
    }

    private function createMerchantPurse(Merchant $merchant, array $purses, string $user_id)
    {
        foreach ($purses as $key => $purse) {
            $purses[$key]['user_id'] = $user_id;
        }
        $merchant->merchantUser()->createMany($purses);
    }

    private function updateMerchantPurse(Merchant $merchant, array $purses, string $user_id)
    {
        foreach ($purses as $purse) {
            // todo: implement sync
            MerchantPurse::query()->updateOrCreate(
                [
                    'user_id' => $user_id,
                    'purse_id' => $purse['purse_id'],
                    'merchant_id' => $merchant->id,
                ],
                [
                    'percentage' => $purse['percentage'],
                    'fee' => $purse['fee'],
                ]
            );
        }
    }

    private function syncTags(Merchant $merchant, array $data)
    {
        if (isset($data['tags'])) {
            $merchant->tags()->sync($data['tags']);
        }
    }

    private function syncCategories(Merchant $merchant, array $data)
    {
        if (isset($data['categories'])) {
            $merchant->categories()->sync($data['categories']);
        }
    }
}
