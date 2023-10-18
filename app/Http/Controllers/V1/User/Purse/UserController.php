<?php

namespace App\Http\Controllers\V1\User\Purse;

use App\Jobs\Purse\GetJob;
use App\Jobs\Purse\ReadJob;
use Illuminate\Http\Request;
use App\Jobs\Purse\DeleteJob;
use App\Jobs\Purse\UpdateJob;
use App\Jobs\Purse\CreateJob;
use App\Jobs\Purse\AddUserJob;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurseResource;
use App\Jobs\Purse\User\DeleteUserJob;
use App\Jobs\Purse\User\UpdateUserPurseJob;
use App\Http\Requests\Purse\PurseUpdateRequest;
use App\Http\Requests\Purse\CreatePurseRequest;
use App\Http\Requests\Purse\AddUserPurseRequest;
use App\Http\Requests\Purse\UpdateUserPurseRequest;

class UserController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $data = $request->only(['id','name','currency','status', 'number','color','balance','freeze','crated_at','sort']);
        return $this->response(PurseResource::collection(dispatch_sync(new GetJob($request->user()['id'],$data))));
    }

    public function create(CreatePurseRequest $request): JsonResponse
    {
        return $this->response(PurseResource::make(dispatch_sync(new CreateJob($request->user()['id'], $request->validated()))));
    }

    public function read($uuid)
    {
        return $this->response(PurseResource::make(dispatch_sync(new ReadJob($uuid))));
    }

    public function update(string $id, PurseUpdateRequest $request): JsonResponse
    {
        return $this->setUpdatedMessage()->response(PurseResource::make($this->dispatch(new UpdateJob($id, $request->validated()))));
    }

    public function delete(Request $request): JsonResponse
    {
        return $this->response(dispatch_sync(new DeleteJob($request->route('uuid'))));
    }

    public function addUser(AddUserPurseRequest $request)
    {
        $data = $request->validated();
        return $this->response(dispatch_sync(new AddUserJob($data)));
    }

    public function updateUser(string $uuid, UpdateUserPurseRequest $request)
    {
        return $this->response(dispatch_sync(new UpdateUserPurseJob($uuid, $request->validated())));
    }

    public function deleteUser(string $uuid)
    {
        return $this->response(dispatch_sync(new DeleteUserJob($uuid)));
    }
}
