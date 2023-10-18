<?php

namespace App\Services\Crypto\Tron;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class TronService
{

    public function __construct($network = 'mainnet')
    {
        $this->client = new Client([
            'base_uri' => $this->setNetwork($network),
            'timeout' => 2.0,
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'TRON-PRO-API-KEY' => Config::get('azpays.crypto.tron.trongrid.key'),
            ],
        ]);
    }

    private function setNetwork($network){
        switch ($network) {
            case 'mainnet':
            default:
                return Config::get('azpays.crypto.tron.trongrid.mainnet');
            case 'shasta':
                return Config::get('azpays.crypto.tron.trongrid.shasta');
            case 'nile':
                return Config::get('azpays.crypto.tron.trongrid.nile');
        }
    }



}
