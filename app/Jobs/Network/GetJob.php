<?php

namespace App\Jobs\Network;

use App\Jobs\SyncJob;
use App\Repositories\Networks\INetworkRepository;

class GetJob extends SyncJob
{
    private INetworkRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id, private array $data)
    {
        $this->repository = app()->make(INetworkRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->repository->networkList($this->user_id, $this->data);
    }
}
