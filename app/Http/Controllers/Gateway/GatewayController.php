<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gateway\CreateGatewayRequest;
use App\Http\Requests\Gateway\GatewayUpdateRequest;
use App\Http\Resources\GatewayResource;
use App\Jobs\Gateway\CreateJob;
use App\Jobs\Gateway\DeleteJob;
use App\Jobs\Gateway\GetJob;
use App\Jobs\Gateway\ReadJob;
use App\Jobs\Gateway\UpdateJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function __construct()
    {
        //
    }

    public function get(Request $request) : JsonResponse
    {
        $data = $request->only(['name', 'status', 'date', 'sort']);

        return $this->respond(GatewayResource::collection(dispatch_sync(new GetJob($request->user()['id'], $data))));
    }

    public function read($id, Request $request): JsonResponse
    {
        return $this->respond(GatewayResource::make(dispatch_sync(new ReadJob($id, $request->user()['id']))));
    }

    public function create(CreateGatewayRequest $request): JsonResponse
    {
        return $this->setCreatedMessage()->respond(GatewayResource::make(dispatch_sync(new CreateJob($request))));
    }

    public function update($id, GatewayUpdateRequest $request): JsonResponse
    {
        return $this->setUpdatedMessage()->respond(GatewayResource::make(dispatch_sync(new UpdateJob($id, $request))));
    }

    public function delete($id, Request $request): JsonResponse
    {
        dispatch_sync(new DeleteJob($id, $request->user()['id']));

        return $this->setDeletedMessage()->respond();
    }
}
