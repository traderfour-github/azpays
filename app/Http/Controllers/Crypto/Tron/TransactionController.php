<?php

namespace App\Http\Controllers\Crypto\Tron;

use App\Http\Controllers\Controller;
use App\Services\Crypto\Tron\TransactionService;

class TransactionController extends Controller
{

    public function __construct(
        private TransactionService $transactionService
    ) {
    }

    public function read(string $transactionID){
        $this->transactionService->read($transactionID);
    }

    public function info(string $transactionID){
        $this->transactionService->info($transactionID);
    }

    public function check(string $transactionHash){
        $this->transactionService->check($transactionHash);
    }

}
