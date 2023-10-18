<?php

namespace App\Services\Merchant;


use App\Repositories\MerchantRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MerchantService
{
    public function __construct(
        private MerchantRepository $merchantRepository
    ) {
    }

    public function merchantList(string $user_id,array $data)
    {
        return $this->merchantRepository->merchantList($user_id,$data);
    }

    public function createMerchant(string $user_id,array $data)
    {
        return $this->merchantRepository->createMerchant($user_id,$data);
    }

    public function readMerchant(string $user_id,string $id)
    {
        return $this->merchantRepository->readMerchant($user_id,$id);
    }


    public function updateMerchant(string $uuid, string $user_id, array $data)
    {
        return $this->merchantRepository->updateMerchant($uuid, $user_id, $data);
    }

    public function deleteMerchant(string $merchantId)
    {

        return $this->merchantRepository->deleteMerchant($merchantId);
    }

    public function reformTags(array $tags):string
    {
        $result=[];
        foreach ($tags as $key => $tag){
            $data = trim(strtolower($tag));
            $result [] = str_replace(' ', '-', $data);
        }
        return implode(',',$result);

    }

     public function upload($image):string
    {
        $extension = $image->extension();
        $filename = Str::uuid() . "." . $extension;
        $path = config('azpays.merchant.logo_path') . $filename;
        Storage::cloud()->put($path, file_get_contents($image));
        return $path;
    }



}
