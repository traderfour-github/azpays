<?php

namespace App\Services\Crypto\Tron;

class ContractService extends TronService
{

    public function __construct(
//        private AddressRepository $addressRepository
    ){
        parent::__construct(config('azpays.crypto.tron.network'));
    }

    public function transactions(string $contractAddress){
        $res = $this->client->request('GET', '/v1/contracts/'.$contractAddress.'/transactions');
        echo $res->getBody();
    }

}
