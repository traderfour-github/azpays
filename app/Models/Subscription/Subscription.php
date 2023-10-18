<?php

namespace App\Models\Subscription;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'subscribable_type', 'subscribable_id', 'title',
        'description', 'introduction', 'charity', 'amount', 'currency',
        'period', 'entry_fee', 'max_capacity', 'max_trials', 'refundable',
        'invite_only', 'private', 'webhook', 'status',
    ];

    public function discounts()
    {
        return $this->morphMany(Discount::class, 'discountable', 'discountables');
    }

    public function subscriptionPlans(): HasMany
    {
        return $this->hasMany(SubscriptionPlan::class);
    }

    public function subscriptionPurchases(): HasMany
    {
        return $this->hasMany(SubscriptionPurchase::class);
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, SubscriptionPurchase::class);
    }
}
