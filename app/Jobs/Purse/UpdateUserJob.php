<?php

namespace App\Jobs\Purse\User;

use App\Events\Purse\UpdateUserEvent;
use App\Jobs\SyncJob;
use App\Repositories\Purse\IPurseRepository;

class UpdateUserPurseJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id, private $data)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }


    public function handle()
    {
        $result = $this->purseRepository->updateUser($this->id, $this->data['user_id'], $this->data['percentage']);

        if($result){
            event(new UpdateUserEvent($result));
            return $result;
        }

        return [];
    }
}
