<?php

namespace App\Jobs\Payment;

use App\Jobs\SyncJob;
use App\Http\Resources\PaymentResource;
use App\Repositories\Payments\IPaymentRepository;

class ReadJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $payee_id, private $uuid)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return$this->paymentRepository->paymentDetail($this->payee_id, $this->uuid);
    }
}
