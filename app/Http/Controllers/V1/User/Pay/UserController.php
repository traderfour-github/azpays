<?php

namespace App\Http\Controllers\V1\User\Pay;

use Illuminate\Http\Request;
use App\Jobs\Payment\PayJob;
use App\Http\Controllers\Controller;
use App\Jobs\Payment\TransferInfoJob;
use App\Http\Resources\Payment\PayResource;
use App\Http\Requests\Payment\PaymentStartRequest;

class UserController extends Controller
{
    public function pay(PaymentStartRequest $request)
    {
        return $this->response(new PayResource(dispatch_sync(new PayJob($request->route('token'), $request->validated()))));
    }

    public function transferInfo(Request $request)
    {
        return $this->response(new PayResource(dispatch_sync(new TransferInfoJob($request->route('token'), $request->route('gateway_id')))));
    }
}
