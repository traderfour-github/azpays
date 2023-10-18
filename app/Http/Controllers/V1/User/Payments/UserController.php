<?php

namespace App\Http\Controllers\V1\User\Payments;

use Illuminate\Http\Request;
use App\Jobs\Payment\GetJob;
use App\Jobs\Payment\ReadJob;
use App\Jobs\Payment\StoreJob;
use App\Jobs\Payment\DeleteJob;
use App\Jobs\Payment\UpdateJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;

class UserController extends Controller
{
    public function get(Request $request)
    {
        return $this->response(PaymentResource::collection(dispatch_sync(new GetJob($request->user()['id']))));
    }

    public function create(CreatePaymentRequest $request)
    {
        $data = $request->only([
            'amount',
            'merchant_id',
            'metas',
            'currency',
            'factor',
            'description',
            'webhook',
            'callback',
            'payee_id'
        ]);

        return $this->response(dispatch_sync(new StoreJob($data)));
    }

    public function read(Request $request)
    {
        return $this->response(new PaymentResource(dispatch_sync(new ReadJob($request->user()['id'], $request->route('payment_id')))));
    }

    public function update(UpdatePaymentRequest $request)
    {
        $data = $request->only([
            'amount',
            'merchant_id',
            'currency',
            'factor',
            'description',
            'webhook',
            'callback',
            'metas'
        ]);

        return $this->response(dispatch_sync(new UpdateJob($request->user()['id'], $data)));
    }

    public function delete(Request $request)
    {
        return $this->response( dispatch_sync(new DeleteJob($request->route('payment_id'))));
    }
}
