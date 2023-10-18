<?php

namespace App\Jobs\Purse;

use App\Jobs\SyncJob;
use App\Events\Purse\DeleteUserEvent;
use App\Repositories\Purse\IPurseRepository;

class DeleteUserJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }

    public function handle()
    {
        $result = $this->purseRepository->deleteUser($this->id);
        if ($result) {
            event(new DeleteUserEvent($this->id));
            return $result;
        }

        return [];
    }
}
