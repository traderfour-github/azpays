<?php

namespace App\Jobs\Merchant;

use App\Jobs\SyncJob;
use App\Repositories\Transactions\ITransactionRepository;

class TransactionsJob extends SyncJob
{
    private ITransactionRepository $transactionRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id, private string $merchant_id)
    {
        $this->transactionRepository = app()->make(ITransactionRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->transactionRepository->merchantTransactionsList($this->user_id, $this->merchant_id);
    }
}
