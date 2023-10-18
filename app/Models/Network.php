<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Network extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    const TABLE = 'networks';

    const ID = 'id';
    const GATEWAY_ID = 'gateway_id';
    const NAME = 'name';
    const LOGO = 'logo';
    const FEE = 'fee';
    const SUPPORT_PORTAL = 'support_portal';
    const SUPPORT_EMAIL = 'support_email';
    const SUPPORT_PHONE = 'support_phone';
    const PROCESSING_TIME = 'processing_time';
    const CONFIRM_TIME = 'confirm_time';
    const PAYOUT_TIME = 'payout_time';
    const COUNTRIES = 'countries';
    const PROCESSORS = 'processors';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::GATEWAY_ID,
        self::NAME,
        self::LOGO,
        self::FEE,
        self::SUPPORT_PORTAL,
        self::SUPPORT_EMAIL,
        self::SUPPORT_PHONE,
        self::PROCESSING_TIME,
        self::CONFIRM_TIME,
        self::PAYOUT_TIME,
        self::COUNTRIES,
        self::PROCESSORS,
    ];

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, self::GATEWAY_ID, Gateway::ID);
    }
}
