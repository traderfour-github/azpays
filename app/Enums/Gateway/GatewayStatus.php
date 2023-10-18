<?php

namespace App\Enums\Gateway;

enum GatewayStatus: int
{
    case REGISTERED = 14101;
    case ACTIVATED = 14102;
    case INACTIVATED = 14103;
}
