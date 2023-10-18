<?php

namespace App\Services\Crypto\Tron;

class TransactionService extends TronService
{

    public function __construct(
//        private AddressRepository $addressRepository
    ){
        parent::__construct(config('azpays.crypto.tron.network'));
    }

    public function read(string $transactionID){
        $res = $this->client->post( '/wallet/gettransactionbyid', [
            'body' => '{"value":"'.$transactionID.'"}'
        ]);
        echo $res->getBody();
    }

    public function info(string $transactionID){
        $res = $this->client->post( '/wallet/gettransactioninfobyid', [
            'body' => '{"value":"'.$transactionID.'"}'
        ]);
        echo $res->getBody();
    }

    public function check(string $transactionHash, $transaction){
        $result = $this->client->get('https://apilist.tronscan.org/api/transaction-info?hash=' . $transactionHash);
        $result = json_decode($result->getBody());
        $transactionInfo=$result->trigger_info->parameter;
        $receiver=$transactionInfo->_to;
        $value = substr($transactionInfo->_value, 0, -4);
        $dollars = substr($value, 0, -2);
        $cents = substr($value, -2);
        $amount=doubleval($dollars . '.' . $cents);
        //@TODO: Make compatible with DB and logics.
        //@TODO: Only suppoty USDT for now. on Tron network.
        if ($transaction['receiver'] === $receiver
            && $result->trigger_info->contract_address=config('azpays.crypto.tron.contracts.usdt')
            && $result->confirmed === true
            && doubleval($transaction['amount']) === $amount) {
            return true;
        }
        return false;
    }

}
