<?php

namespace App\Events\Payment;

use App\Models\Payment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentVerifiedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Payment $payment Payment.
     */
    public function __construct(public Payment $payment)
    {
        $this->payment = $payment;
    }
}
