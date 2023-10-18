<?php

namespace App\Jobs\Payment\Pipes;

use App\Enums\Payment\PaymentStatus;
use App\Models\Payment;
use Closure;

class CheckStatusPipe
{
    public function handle(PaymentBasePipe $basePipe, Closure $next)
    {
        if ($basePipe->payment->{Payment::STATUS} == PaymentStatus::CONFIRMED) {
            $basePipe->errorMessages[] = __('messages.payment.payment_already_confirmed');
        }

        return $next($basePipe);
    }
}
