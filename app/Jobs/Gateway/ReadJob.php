<?php

namespace App\Jobs\Gateway;

use App\Jobs\SyncJob;
use App\Repositories\Gateways\IGatewayRepository;

class ReadJob extends SyncJob
{
    private IGatewayRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $uuid, private $user_id)
    {
        $this->repository = app()->make(IGatewayRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->repository->gatewayDetail($this->uuid, $this->user_id);
    }
}
