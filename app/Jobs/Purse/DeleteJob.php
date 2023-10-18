<?php

namespace App\Jobs\Purse;

use App\Jobs\SyncJob;
use App\Events\Purse\DeleteEvent;
use App\Repositories\Purse\IPurseRepository;

class DeleteJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }

    public function handle() : void
    {
        $result = $this->purseRepository->deletePurse($this->id);

        if($result){
            event(new DeleteEvent($this->id));
            return $result;
        }

        return [];
    }
}
