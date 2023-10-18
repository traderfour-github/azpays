<?php

namespace App\Models;

use App\Enums\Discount\DiscountStatusEnum;
use App\Enums\Discount\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'code', 'description', 'type',
        'value', 'max_value', 'max_use',
        'use_count', 'max_use_per_user', 'first_purchase',
        'start_at', 'expired_at', 'status',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'expired_at' => 'datetime',
        'first_purchase' => 'boolean',
        'type' => DiscountTypeEnum::class,
        'status' => DiscountStatusEnum::class,
    ];

    public function subscriptions()
    {
        return $this->morphedByMany(Subscription::class, 'discountable');
    }
}
