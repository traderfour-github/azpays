<?php

namespace App\Repositories\Networks;

use EloquentBuilder;
use App\Models\Gateway;
use App\Models\Network;
use App\Repositories\Contracts\AbstractRepository;

class NetworkRepository extends AbstractRepository implements INetworkRepository
{
    protected $model = Network::class;

    public function networkList($user_id, array $data)
    {
        if (empty($data)) {
            return $this->getModel()->whereHas('gateway', function ($gatewayQuery) use ($user_id) {
                return $gatewayQuery->whereHas('user', function ($userQuery) use ($user_id) {
                    return $userQuery->where(Gateway::USER_ID, $user_id);
                });
            })->get();
        } else {
            return EloquentBuilder::to($this->model, $data)
                ->whereHas('gateway', function ($gatewayQuery) use ($user_id) {
                    return $gatewayQuery->whereHas('user', function ($userQuery) use ($user_id) {
                        return $userQuery->where(Gateway::USER_ID, $user_id);
                    });
                })->get();
        }
    }

    public function networkDetail(string $uuid, $user_id)
    {
        return $this->getModel()->whereHas('gateway', function ($gatewayQuery) use ($user_id) {
            return $gatewayQuery->whereHas('user', function ($userQuery) use ($user_id) {
                return $userQuery->where(Gateway::USER_ID, $user_id);
            });
        })->where(Network::ID, $uuid)->firstOrFail();
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

    public function getNetworksByGatewaysIds(array $gatewaysIds)
    {
        return $this->getModel()->whereIn(Network::GATEWAY_ID, $gatewaysIds)->get();
    }
}
