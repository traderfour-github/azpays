<?php

namespace App\Jobs\Rate;

use App\Jobs\SyncJob;
use App\Repositories\Rates\IRateRepository;

class ReadJob extends SyncJob
{
    private IRateRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $uuid, private $user_id)
    {
        $this->repository = app()->make(IRateRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->repository->rateDetail($this->uuid, $this->user_id);
    }
}
