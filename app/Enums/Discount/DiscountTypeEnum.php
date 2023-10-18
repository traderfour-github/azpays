<?php

namespace App\Enums\Discount;

use App\Enums\EnumTrait;

enum DiscountTypeEnum: int
{
    use EnumTrait;
    case Amount = 1;
    case Percent = 2;
}
