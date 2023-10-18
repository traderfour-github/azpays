<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gateway extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    const TABLE = 'gateways';

    const ID = 'id';
    const USER_ID = 'user_id';
    const NAME = 'name';
    const LOGO = 'logo';
    const STATUS = 'status';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::USER_ID,
        self::NAME,
        self::LOGO,
        self::STATUS,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::USER_ID, User::ID);
    }

    public function networks(): HasMany
    {
        return $this->hasMany(Network::class, Network::GATEWAY_ID, self::ID);
    }
}
