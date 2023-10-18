<?php

namespace App\Enums\Subscription;

use App\Enums\EnumTrait;

enum SubscriptionStatusEnum: int
{
    use EnumTrait;
    case Active = 1;
    case InActive = 2;
}
