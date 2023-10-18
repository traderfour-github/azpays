<?php

namespace App\Enums\Payment;

abstract class PaymentStatus
{

    const REGISTERED = 13010;
    const STARTED = 13011;
    const DETECTED = 13012;
    const VERIFYING = 13013;
    const CONFIRMED = 13014;
    const CANCELED = 13015;

}
