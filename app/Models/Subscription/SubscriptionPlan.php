<?php

namespace App\Models\Subscription;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $table = 'subscription_plans';

    public static array $STATUS = ["active", "inactive", "under supervision", "hold"];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
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
