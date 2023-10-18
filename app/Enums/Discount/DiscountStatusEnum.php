<?php

namespace App\Enums\Discount;

use App\Enums\EnumTrait;

enum DiscountStatusEnum: int
{
    use EnumTrait;
    case Active = 1;
    case InActive = 2;
    case Expired = 3;
}
