<?php

namespace App\Enums\Transaction;

abstract class TransactionType
{
    const DEPOSIT = 12400;
    const WITHDRAWAL = 12401;
    const TRANSFER = 12402;
    const CREDIT = 12403;
}
