<?php

namespace App\Enums\Purse;

abstract class Type
{
    const GENERAL = 12000;
    const DEPOSIT = 12001;
    const WITHDRAW = 12002;
    const TRANSFER = 12003;
    const REFUND = 12004;
    const BONUS = 12005;
    const COMMISSION = 12006;
    const CASHBACK = 12007;
    const CASHBACK_REFUND = 12008;
    const CASHBACK_BONUS = 12009;
    const CASHBACK_COMMISSION = 12010;
    const TEMPORARY = 12011;
}
