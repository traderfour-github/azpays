<?php

namespace App\Services\Crypto\Tron;

class AddressService extends TronService
{

    public function __construct(
//        private AddressRepository $addressRepository
    ){
        parent::__construct(config('azpays.crypto.tron.network'));
    }
    public function generate(){
        $res = $this->client->request('GET', 'wallet/generateaddress');
        echo $res->getBody();
    }

    public function verify(string $address){
        $res = $this->client->request('POST', 'wallet/validateaddress', [
            'body' => '{"address":"'.$address.'"}',
        ]);
        echo $res->getBody();
    }

    public function info(string $address){
        $res = $this->client->request('GET', '/v1/accounts/'.$address);
        echo $res->getBody();
    }

    public function transactions(string $address){
        $res = $this->client->request('GET', '/v1/accounts/'.$address.'/transactions');
        echo $res->getBody();
    }

}
