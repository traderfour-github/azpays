<?php

namespace App\Exceptions\Discount;

class DiscountNotActiveException extends \Exception
{
    protected $message = 'Discount not active';
}
