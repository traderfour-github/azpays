<?php

namespace App\Models;

use App\Concerns\HasMetas;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasUuids, HasFactory, SoftDeletes, HasMetas;

    const TABLE = 'payments';

    const ID = 'id';
    const TOKEN = 'token';
    const MERCHANT_ID = 'merchant_id';
    const PAYEE_ID = 'payee_id';
    const PAYER_ID = 'payer_id';
    const AMOUNT = 'amount';
    const CURRENCY = 'currency';
    const FACTOR = 'factor';
    const DESCRIPTION = 'description';
    const STARTED_AT = 'started_at';
    const VERIFIED_AT = 'verified_at';
    const DELETED_AT = 'deleted_at';
    const STATUS = 'status';

    protected $table = self::TABLE;

    protected $connection = 'mysql';
//    protected $connection = 'postgres'; // @TODO: Deploy on postgres on production.

    protected $fillable=[
        self::TOKEN,
        self::MERCHANT_ID,
        self::PAYEE_ID,
        self::PAYER_ID,
        self::AMOUNT,
        self::CURRENCY,
        self::FACTOR,
        self::DESCRIPTION,
        self::STARTED_AT,
        self::VERIFIED_AT,
        self::STATUS,
    ];

    public function paymentTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'payment_id', self::ID);
    }

    public function payee(): BelongsTo
    {
        return $this->belongsTo(User::class, self::PAYEE_ID, User::ID);
    }

    protected $casts = [
        self::STARTED_AT => 'datetime',
        self::VERIFIED_AT => 'datetime',
    ];
}
