<?php

namespace App\Enums\Subscription;

use App\Enums\EnumTrait;

enum SubscriptionCapacityEnum: int
{
    use EnumTrait;
    case MoreThanThousand = 0;
}
