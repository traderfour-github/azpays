<?php

namespace App\Repositories\Rates;

use EloquentBuilder;
use App\Models\Rate;
use App\Models\Gateway;
use App\Repositories\Contracts\AbstractRepository;

class RateRepository extends AbstractRepository implements IRateRepository
{
    protected $model = Rate::class;

    public function rateList($user_id, array $data)
    {
        if (empty($data)) {
            return $this->getModel()->whereHas('network', function ($networkQuery) use ($user_id) {
                return $networkQuery->whereHas('gateway', function ($gatewayQuery) use ($user_id) {
                    return $gatewayQuery->whereHas('user', function ($userQuery) use ($user_id) {
                        return $userQuery->where(Gateway::USER_ID, $user_id);
                    });
                });
            })->get();
        } else {
            return EloquentBuilder::to($this->model, $data)
                ->whereHas('network', function ($networkQuery) use ($user_id) {
                    return $networkQuery->whereHas('gateway', function ($gatewayQuery) use ($user_id) {
                        return $gatewayQuery->whereHas('user', function ($userQuery) use ($user_id) {
                            return $userQuery->where(Gateway::USER_ID, $user_id);
                        });
                    });
                })->get();
        }
    }

    public function rateDetail(string $uuid, $user_id)
    {
        return $this->getModel()->whereHas('network', function ($networkQuery) use ($user_id) {
            return $networkQuery->whereHas('gateway', function ($gatewayQuery) use ($user_id) {
                return $gatewayQuery->whereHas('user', function ($userQuery) use ($user_id) {
                    return $userQuery->where(Gateway::USER_ID, $user_id);
                });
            });
        })->where(Rate::ID, $uuid)->firstOrFail();
    }

    public function create($data)
    {
        return $this->getModel()->create($data);
    }

    public function update(string $id, array $data)
    {
        return $this->getModel()->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->getModel()->find($id)->delete();
    }

    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
    }
}
