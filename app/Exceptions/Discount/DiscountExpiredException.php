<?php

namespace App\Exceptions\Discount;

class DiscountExpiredException extends \Exception
{
    protected $message = 'Discount expired';
}
