<?php

namespace App\Jobs\Payment;

use App\Enums\Payment\PaymentStatus;
use App\Jobs\SyncJob;
use Illuminate\Support\Str;
use App\Events\Payment\StoreEvent;
use App\Repositories\Payments\IPaymentRepository;
use Carbon\Carbon;

class DeleteJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $payment = $this->paymentRepository->readPaymentByToken($this->id);
        if($payment->status != PaymentStatus::CANCELED || !$this->expiredStart($payment->started_at))
            throw new \Exception('Payment can not be deleted');

        return $this->paymentRepository->delete($this->id);
    }

    protected function expiredStart($started_at){
        return Carbon::make($started_at)->addHour()->isPast();
    }
}
