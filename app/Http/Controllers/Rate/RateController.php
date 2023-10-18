<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rate\CreateRateRequest;
use App\Http\Requests\Rate\RateUpdateRequest;
use App\Http\Resources\RateResource;
use App\Jobs\Rate\CreateJob;
use App\Jobs\Rate\DeleteJob;
use App\Jobs\Rate\GetJob;
use App\Jobs\Rate\ReadJob;
use App\Jobs\Rate\UpdateJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __construct()
    {
        //
    }

    public function get(Request $request): JsonResponse
    {
        $data = $request->only(['base', 'currency', 'date', 'sort']);

        return $this->respond(RateResource::collection(dispatch_sync(new GetJob($request->user()['id'], $data))));
    }

    public function read($id, Request $request): JsonResponse
    {
        return $this->respond(RateResource::make(dispatch_sync(new ReadJob($id, $request->user()['id']))));
    }

    public function create(CreateRateRequest $request): JsonResponse
    {
        return $this->setCreatedMessage()->respond(RateResource::make(dispatch_sync(new CreateJob($request->validated()))));
    }

    public function update($id, RateUpdateRequest $request): JsonResponse
    {
        return $this->setUpdatedMessage()->respond(RateResource::make(dispatch_sync(new UpdateJob($id, $request->validated()))));
    }

    public function delete($id, Request $request): JsonResponse
    {
        dispatch_sync(new DeleteJob($id, $request->user()['id']));

        return $this->setDeletedMessage()->respond();
    }
}
