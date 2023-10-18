<?php

namespace App\Jobs\Rate;

use App\Jobs\SyncJob;
use App\Repositories\Rates\IRateRepository;

class GetJob extends SyncJob
{
    private IRateRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id, private array $data)
    {
        $this->repository = app()->make(IRateRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->repository->rateList($this->user_id, $this->data);
    }
}
