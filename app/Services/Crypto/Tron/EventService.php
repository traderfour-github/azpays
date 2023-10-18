<?php

namespace App\Services\Crypto\Tron;

class EventService extends TronService
{

    public function __construct(
//        private AddressRepository $addressRepository
    ){
        parent::__construct(config('azpays.crypto.tron.network'));
    }

    public function transactions(string $transactionID){
        $res = $this->client->request('GET', '/v1/transactions/'.$transactionID.'/events');
        echo $res->getBody();
    }

}
