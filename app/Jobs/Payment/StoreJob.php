<?php

namespace App\Jobs\Payment;

use App\Jobs\SyncJob;
use Illuminate\Support\Str;
use App\Events\Payment\StoreEvent;
use App\Repositories\Payments\IPaymentRepository;

class StoreJob extends SyncJob
{
    private IPaymentRepository $paymentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $data)
    {
        $this->paymentRepository = app()->make(IPaymentRepository::class);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        $data['token'] = $this->generateToken();
        $result = $payment = $this->paymentRepository->createPayment($data);
        if(!is_null($data['metas'])){
            $this->metaService->create($payment, $data['metas']);
        }

        if($result){
            event(new StoreEvent($result));
            return $result;
        }

        return [];
    }

    protected function generateToken()
    {
        return Str::random(8);
    }

}
