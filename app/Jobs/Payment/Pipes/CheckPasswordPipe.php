<?php

namespace App\Jobs\Payment\Pipes;

use App\Enums\Payment\PaymentMeta;
use Closure;
use Illuminate\Support\Facades\Hash;

class CheckPasswordPipe
{
    public function handle(PaymentBasePipe $basePipe, Closure $next)
    {
        foreach ($basePipe->metas as $meta) {
            if ($meta->key == PaymentMeta::Password &&
                ! Hash::check($basePipe->params[PaymentMeta::Password], $meta->value)
            ) {
                $basePipe->errorMessages[] = __('messages.payment.wrong_password');
            }
        }

        return $next($basePipe);
    }
}
