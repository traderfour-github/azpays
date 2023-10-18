<?php

namespace App\Http\Controllers\V1\User\Transactions;

use Illuminate\Http\Request;
use App\Jobs\Transaction\GetJob;
use App\Jobs\Transaction\ReadJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $data = $request->only(['authority','trace_number','amount','type','payer_id','date']);
        return $this->response(TransactionResource::collection(dispatch_sync(new GetJob($request->user()['id'], $data))));
    }

    public function read($id, Request $request)
    {
        return $this->response(TransactionResource::make(dispatch_sync(new ReadJob($id, $request->user()['id']))));
    }
}
