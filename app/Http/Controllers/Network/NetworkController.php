<?php

namespace App\Http\Controllers\Network;

use App\Http\Controllers\Controller;
use App\Http\Requests\Network\CreateNetworkRequest;
use App\Http\Requests\Network\NetworkUpdateRequest;
use App\Http\Resources\NetworkResource;
use App\Jobs\Network\CreateJob;
use App\Jobs\Network\DeleteJob;
use App\Jobs\Network\GetJob;
use App\Jobs\Network\ReadJob;
use App\Jobs\Network\UpdateJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function __construct()
    {
        //
    }

    public function get(Request $request) : JsonResponse
    {
        $data = $request->only(['name', 'gateway_id', 'date', 'sort', 'countries']);

        return $this->respond(NetworkResource::collection(dispatch_sync(new GetJob($request->user()['id'], $data))));
    }

    public function read($id, Request $request): JsonResponse
    {
        return $this->respond(NetworkResource::make(dispatch_sync(new ReadJob($id, $request->user()['id']))));
    }

    public function create(CreateNetworkRequest $request): JsonResponse
    {
        return $this->setCreatedMessage()->respond(NetworkResource::make(dispatch_sync(new CreateJob($request))));
    }

    public function update($id, NetworkUpdateRequest $request): JsonResponse
    {
        return $this->setUpdatedMessage()->respond(NetworkResource::make(dispatch_sync(new UpdateJob($id, $request))));
    }

    public function delete($id, Request $request): JsonResponse
    {
        dispatch_sync(new DeleteJob($id, $request->user()['id']));

        return $this->setDeletedMessage()->respond();
    }
}
