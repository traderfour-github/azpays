<?php

namespace App\Jobs\Payment;

use App\Enums\Payment\PaymentStatus;
use App\Events\Payment\StoreEvent;
use App\Jobs\SyncJob;
use App\Repositories\Payments\IPaymentRepository;

class UpdateJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private $id, private array $data)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        $payment = $this->paymentRepository->findOrFail($this->id);
        if($payment->status == PaymentStatus::CANCELED
            || $payment->status == PaymentStatus::REGISTERED ){
            if (array_key_exists('metas', $this->data)){
                $this->metaService->update($payment, $this->data['metas']);
                unset($data['metas']);
            }
            return $this->paymentRepository->update($this->id, $this->data);
        }
        throw new \Exception('Payment can not be updated');
        $result = $this->paymentRepository->create($this->data);

        if($result){
            event(new StoreEvent($result));
            return $result;
        }

        return [];
    }
}
