<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    const TABLE = 'rates';

    const ID = 'id';
    const NETWORK_ID = 'network_id';
    const BASE = 'base';
    const CURRENCY = 'currency';
    const SELL = 'sell';
    const BUY = 'buy';
    const DESCRIPTION = 'description';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::NETWORK_ID,
        self::BASE,
        self::CURRENCY,
        self::SELL,
        self::BUY,
        self::DESCRIPTION,
    ];

    public function network(): BelongsTo
    {
        return $this->belongsTo(Network::class, self::NETWORK_ID, Network::ID);
    }
}
