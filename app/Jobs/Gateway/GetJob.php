<?php

namespace App\Jobs\Gateway;

use App\Jobs\SyncJob;
use App\Repositories\Gateways\IGatewayRepository;

class GetJob extends SyncJob
{
    private IGatewayRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id, private array $data)
    {
        $this->repository = app()->make(IGatewayRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->repository->gatewayList($this->user_id, $this->data);
    }
}
