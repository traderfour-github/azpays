<?php

namespace App\Jobs\Gateway;

use App\Events\Gateway\DeleteEvent;
use App\Repositories\Gateways\IGatewayRepository;

class DeleteJob
{
    private IGatewayRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $id, private $user_id)
    {
        $this->repository = app()->make(IGatewayRepository::class);
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
