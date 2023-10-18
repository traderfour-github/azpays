<?php

namespace App\Jobs\Rate;

use App\Events\Rate\DeleteEvent;
use App\Jobs\SyncJob;
use App\Repositories\Rates\IRateRepository;

class DeleteJob extends SyncJob
{
    private IRateRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $id, private $user_id)
    {
        $this->repository = app()->make(IRateRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $rate = $this->repository->findOrFail($this->id);

        // todo: add authorization
        if ($this->repository->delete($this->id)) {
            event(new DeleteEvent($rate));
        }
    }
}
