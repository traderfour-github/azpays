<?php

namespace App\Jobs\Payment\Pipes;

use Closure;

class CheckCountriesPipe
{
    public function handle(PaymentBasePipe $basePipe, Closure $next)
    {
        $ipAddress = request()->ip();

        foreach ($basePipe->networks as $network) {
            // todo: check if user is not allowed to pay with this ip address
            // according to the countries column in networks table then remove the network from the collection.
        }

        return $next($basePipe);
    }
}
