<?php

namespace App\Jobs\Payment;

use App\Enums\Payment\PaymentStatus;
use App\Events\Payment\PaymentVerifiedEvent;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerifyStartedPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private Payment $payment
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $isPaid = true; // todo: connect to real service

        if ($isPaid) {
            $this->payment->update([
                Payment::STATUS => PaymentStatus::CONFIRMED,
                Payment::VERIFIED_AT => Carbon::now(),
            ]);

            PaymentVerifiedEvent::dispatch();
        } else {
            $this->payment->update([
                Payment::STATUS => PaymentStatus::CANCELED,
            ]);
        }
    }
}
