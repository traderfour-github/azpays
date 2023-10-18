<?php

namespace App\Enums\Currency;

use App\Enums\EnumTrait;

enum CurrencyCodeEnum: int
{
    use EnumTrait;
    case AZPAYS = 1;
}
