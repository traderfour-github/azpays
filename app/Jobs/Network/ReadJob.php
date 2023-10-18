<?php

namespace App\Jobs\Network;

use App\Jobs\SyncJob;
use App\Repositories\Networks\INetworkRepository;

class ReadJob extends SyncJob
{
    private INetworkRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $uuid, private $user_id)
    {
        $this->repository = app()->make(INetworkRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->repository->networkDetail($this->uuid, $this->user_id);
    }
}
