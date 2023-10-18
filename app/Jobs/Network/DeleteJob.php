<?php

namespace App\Jobs\Network;

use App\Events\Network\DeleteEvent;
use App\Repositories\Networks\INetworkRepository;

class DeleteJob
{
    private INetworkRepository $repository;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $id, private $user_id)
    {
        $this->repository = app()->make(INetworkRepository::class);
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
