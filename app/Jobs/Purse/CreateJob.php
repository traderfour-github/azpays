<?php

namespace App\Jobs\Purse;

use App\Jobs\SyncJob;
use App\Events\Purse\StoreEvent;
use App\Repositories\Purse\IPurseRepository;

class CreateJob extends SyncJob
{
    private IPurseRepository $purseRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $user_id, private array $data)
    {
        $this->purseRepository = app()->make(IPurseRepository::class);
    }

    public function handle()
    {
        if (!isset($this->data['user_id'])) $this->data['user_id'] = $this->user_id;
        if (!isset($this->data['address'])) $this->data['address'] = $this->generateAddress();

        $result = $this->purseRepository->createPurse($this->user_id, $this->data);

        if($result){
            event(new StoreEvent($result));
            return $result;
        }

        return [];
    }

    protected function generateAddress(): string
    {
        return 'azp' . bin2hex(random_bytes(10));
    }
}
