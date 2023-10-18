<?php

namespace App\Jobs\Payment\Pipes;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

class PaymentBasePipe
{
    public array $errorMessages = [];

    public function __construct(
        public Payment $payment,
        public ?Collection $metas = null,
        public array $params = [],
        public ?Collection $networks = null,
    ) {
    }
}
