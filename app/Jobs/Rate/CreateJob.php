<?php

namespace App\Jobs\Rate;

use App\Events\Rate\CreateEvent;
use App\Jobs\SyncJob;
use App\Repositories\Rates\IRateRepository;

class CreateJob extends SyncJob
{
    private IRateRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $data)
    {
        $this->repository = app()->make(IRateRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $rate = $this->repository->create($this->data);

        if ($rate) {
            event(new CreateEvent($rate));
            return $rate;
        }

        return [];
    }
}
