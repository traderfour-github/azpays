<?php

namespace App\Jobs\Transaction;

use App\Jobs\SyncJob;
use App\Repositories\Transactions\ITransactionRepository;

class GetJob extends SyncJob
{
    private ITransactionRepository $transactionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private mixed $user_id, private array $data)
    {
        $this->transactionRepository = app()->make(ITransactionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->transactionRepository->get($this->user_id, $this->data);
    }
}
