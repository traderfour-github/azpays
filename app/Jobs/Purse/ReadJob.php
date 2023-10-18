<?php

namespace App\Jobs\Purse;

use App\Jobs\SyncJob;
use App\Repositories\Purse\IPurseRepository;

class ReadJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->purseRepository->readPurse($this->id);
    }
}
