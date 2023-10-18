<?php

namespace App\Jobs\Merchant;

use App\Jobs\SyncJob;
use App\Repositories\Payments\IPaymentRepository;

class PaymentsJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user_id, private string $merchant_id)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->paymentRepository->merchantPaymentsList($this->user_id, $this->merchant_id);
    }
}
