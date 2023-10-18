<?php

namespace App\Http\Controllers\Crypto\Tron;

use App\Http\Controllers\Controller;
use App\Services\Crypto\Tron\AddressService;

class AddressController extends Controller
{

    public function __construct(
        private AddressService $addressService
    ) {
    }

    public function generate()
    {
        return $this->addressService->generate();
    }

    public function verify(string $address)
    {
        return $this->addressService->verify($address);
    }

    public function info(string $address)
    {
        return $this->addressService->info($address);
    }

    public function transactions(string $address)
    {
        return $this->addressService->transactions($address);
    }

}
