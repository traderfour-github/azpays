<?php

namespace App\Jobs\Transaction;

use App\Jobs\SyncJob;
use App\Repositories\Transactions\ITransactionRepository;

class ReadJob extends SyncJob
{
    private ITransactionRepository $transactionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $uuid, private mixed $user_id)
    {
        $this->transactionRepository = app()->make(ITransactionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->transactionRepository->read($this->uuid, $this->user_id);
    }
}
