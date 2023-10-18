<?php

namespace App\Console\Commands;

use App\Jobs\Payment\VerifyStartedPaymentJob;
use App\Repositories\PaymentRepository;
use Illuminate\Console\Command;

class PaymentVerificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:verify-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if started payments are paid or not.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(PaymentRepository $paymentRepository): void
    {
        foreach ($paymentRepository->startedPaymentList() as $payment) {
            dispatch(new VerifyStartedPaymentJob($payment));
        }
    }
}
