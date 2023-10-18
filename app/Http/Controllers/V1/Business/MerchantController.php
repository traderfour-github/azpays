<?php

namespace App\Http\Controllers\V1\Business;

use Illuminate\Http\Request;
use App\Jobs\Merchant\CreateJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Jobs\Merchant\DeleteJob;
use App\Http\Resources\MerchantResource;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\Merchant\CreateMerchantRequest;
use App\Http\Requests\Merchant\MerchantUpdateRequest;
use App\Jobs\Merchant\GetJob;
use App\Jobs\Merchant\PaymentsJob;
use App\Jobs\Merchant\ReadJob;
use App\Jobs\Merchant\TransactionsJob;
use App\Jobs\Merchant\UpdateJob;
use Illuminate\Http\JsonResponse;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->only(['name','status','domain', 'color', 'sort']);

        return $this->response(MerchantResource::collection(dispatch_sync(new GetJob($data, $request->user()['id']))));
    }

    public function read(Request $request)
    {
        return $this->response(MerchantResource::collection(dispatch_sync(new ReadJob($request->user()['id'], $request->route('merchant_id')))));
    }

    public function create(CreateMerchantRequest $request)
    {
        return $this->response(MerchantResource::make(dispatch_sync(new CreateJob($request->route('user_id'), $request->all()))));
    }

    public function update(MerchantUpdateRequest $request)
    {
        $data = $request->validated();
        if($request->logo){
            $data['logo'] = $request->logo;
        }

        return $this->response(MerchantResource::make(dispatch_sync(new UpdateJob($request->user()['id'], $request->route('uuid'), $data))));
    }

    public function delete($id): JsonResponse
    {
        return $this->response(dispatch_sync(new DeleteJob($id)));
    }

    public function transactions(Request $request, string $id)
    {
        return $this->response(TransactionResource::collection(dispatch_sync(new TransactionsJob($request->user()['id'], $id))));
    }

    public function payments(Request $request, string $id)
    {
        return $this->response(PaymentResource::collection(dispatch_sync(new PaymentsJob($request->user()['id'], $id))));
    }
}
