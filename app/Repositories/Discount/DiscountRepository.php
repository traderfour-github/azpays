<?php

namespace App\Repositories\Discount;

use App\Models\Discount;
use App\Repositories\Contracts\AbstractRepository;

class DiscountRepository extends AbstractRepository implements IDiscountRepository
{
    protected $model = Discount::class;
}
