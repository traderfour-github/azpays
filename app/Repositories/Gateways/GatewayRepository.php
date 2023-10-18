<?php

namespace App\Repositories\Gateways;

use EloquentBuilder;
use App\Models\Gateway;
use App\Repositories\Contracts\AbstractRepository;

class GatewayRepository extends AbstractRepository implements IGatewayRepository
{
    protected $model = Gateway::class;

    public function gatewayList($user_id, array $data)
    {
        if (empty($data)) {
            return $this->getModel()->whereHas('user', function ($userQuery) use ($user_id) {
                return $userQuery->where(Gateway::USER_ID, $user_id);
            })->get();
        } else {
            return EloquentBuilder::to($this->model, $data)
                ->whereHas('user', function ($userQuery) use ($user_id) {
                    return $userQuery->where(Gateway::USER_ID, $user_id);
                })->get();
        }
    }

    public function gatewayDetail(string $uuid, $user_id)
    {
        return $this->getModel()->whereHas('user', function ($userQuery) use ($user_id) {
            return $userQuery->where(Gateway::USER_ID, $user_id);
        })->where(Gateway::ID, $uuid)->first();
    }

    public function create($data)
    {
        return $this->getModel()->create($data);
    }

    public function update(string $id, array $data)
    {
        return $this->getModel()->find($id)->update($data);
    }

    public function delete(string $id)
    {
        return $this->getModel()->find($id)->delete();
    }

    public function findOrFail(string $id)
    {
        return $this->getModel()->findOrFail($id);
    }
}
