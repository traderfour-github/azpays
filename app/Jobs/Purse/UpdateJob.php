<?php

namespace App\Jobs\Purse;

use App\Jobs\SyncJob;
use App\Events\Purse\UpdateEvent;
use App\Repositories\Purse\IPurseRepository;

class UpdateJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id, private array $data)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }

    public function handle()
    {
        $result = $this->purseRepository->updatePurse($this->id, $this->data);

        if($result){
            event(new UpdateEvent($result));
            return $result;
        }

        return [];
    }
}
