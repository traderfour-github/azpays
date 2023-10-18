<?php

namespace App\Jobs\Purse;

use App\Jobs\SyncJob;
use App\Events\Purse\AddUserEvent;
use App\Repositories\Purse\IPurseRepository;

class AddUserJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $data)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }

    public function handle(): void
    {
        $result = $this->purseRepository->addUser($this->data['purse_id'], $this->data['user_id'], $this->data['percentage']);

        if($result){
            event(new AddUserEvent($result));
            return $result;
        }

        return [];
    }
}
