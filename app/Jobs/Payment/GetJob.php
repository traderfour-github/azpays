<?php

namespace App\Jobs\Payment;

use App\Jobs\SyncJob;
use App\Repositories\Payments\IPaymentRepository;

class GetJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $user_id)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return $this->paymentRepository->paymentList($this->user_id);
    }
}
