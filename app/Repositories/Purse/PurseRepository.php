<?php

namespace App\Repositories\Purse;

use EloquentBuilder;
use App\Models\Purse\Purse;
use App\Models\Purse\PurseUser;
use App\Repositories\Purse\IPurseRepository;
use App\Repositories\Contracts\AbstractRepository;

class PurseRepository extends AbstractRepository implements IPurseRepository
{
    protected $model = Purse::class;

    public function purseList(string $user_id,array $data=null)
    {
        if (empty($data)) {
            return $this->getModel()->whereHas('purseUser',function ($userQuery)use($user_id){
                return $userQuery->where('user_id',$user_id);
            })->get();
        } else {
            return EloquentBuilder::to($this->getModel(), $data)
                ->whereHas('purseUser',function ($userQuery)use($user_id){
                return $userQuery->where('user_id',$user_id);
            })->get();
        }
    }

    public function createPurse(string $user_id,array $data)
    {
        $purse =  $this->getModel()->create($data);
        PurseUser::create([
            'user_id'=>$user_id,
            'purse_id'=>$purse->id,
            'percentage'=>100
        ]);

        return $purse;
    }

    public function readPurse(string $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function updatePurse(string $id,array $data)
    {
        $purse =  $this->getModel()->find($id);
        $purse->update($data);
        $purse->refresh();

        return $purse;
    }

    public function deletePurse(string $id)
    {
        $purse =  $this->getModel()->find($id);
        if ($purse->balance > 0 || $purse->freeze > 0){
            throw new \Exception('You can not delete purse with balance');
        }
        if($purse->purseUser()->exists()){
            $purse->purseUser()->delete();
        }
        $purse->delete();
    }

    public function addUser(string $purseId, string $userId, int $percentage)
    {
        return PurseUser::create([
            'user_id'=>$userId,
            'purse_id'=>$purseId,
            'percentage'=>$percentage
        ]);
    }

    public function updateUser(string $purseId, string $userId, int $percentage)
    {
        $purseUser = $this->getModel()->find($purseId)->purseUser();
        $purseUser->update([
            'user_id'=>$userId,
            'percentage'=>$percentage,
        ]);

        return $purseUser;
    }

    public function deleteUser(string $id)
    {
        $this->getModel()->find($id)->purseUser()->delete();
    }
}
