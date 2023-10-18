<?php

namespace App\Repositories;

use App\Models\Discount;
use App\Repositories\Contracts\AbstractRepository;

class DiscountRepository extends AbstractRepository
{
    protected $model = Discount::class;
}
