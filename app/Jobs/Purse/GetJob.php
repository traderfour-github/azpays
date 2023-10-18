<?php

namespace App\Jobs\Purse;

use App\Jobs\SyncJob;
use App\Repositories\Purse\IPurseRepository;

class GetJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $user_id, private array $data)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->purseRepository->purseList($this->user_id, $this->data);
    }
}
