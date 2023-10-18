<?php

namespace App\Http\Controllers\Crypto\Tron;

use App\Http\Controllers\Controller;
use App\Services\Crypto\Tron\ContractService;

class ContractController extends Controller
{

    public function __construct(
        private ContractService $contractService
    ) {
    }
    public function transactions(string $contractAddress)
    {
        return $this->contractService->transactions($contractAddress);
    }

}
