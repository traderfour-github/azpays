<?php

namespace App\Jobs\Rate;

use App\Events\Rate\UpdateEvent;
use App\Jobs\SyncJob;
use App\Repositories\Rates\IRateRepository;

class UpdateJob extends SyncJob
{
    private IRateRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id, private array $data)
    {
        $this->repository = app()->make(IRateRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $rate = $this->repository->findOrFail($this->id);

        if ($this->repository->update($rate->id, $this->data)) {
            $rate->refresh();

            event(new UpdateEvent($rate));

            return $rate;
        }

        return [];
    }
}
