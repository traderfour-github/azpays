<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'transactions';

    public static $type = [
        'DEPOSIT' => 0,
        'WITHDRAWAL' => 1,
        'TRANSFER' => 2,
        'REFUND' => 3,
        'FEE' => 4,
        'TAX' => 5,
        'SYSTEM' => 6,
    ];


    protected $connection = 'mysql';
//    protected $connection = 'postgres'; // @TODO: Deploy on postgres on production.

    protected $fillable=[
        'authority', 'type', 'payee_id', 'payee_pre_balance',
        'payee_post_balance', 'payer_pre_balance', 'payer_post_balance',
        'payer_id', 'payer_balance', 'amount', 'description',
        'user_description', 'trace_number', 'currency', 'detected_at',
        'verified_at', 'status', 'transactional_id', 'transactional_type',
        'gateway_id', 'network_id', 'rate_id'
    ];

    public function transactional()
    {
        return $this->morphTo();
    }

    public function paymentTransactions()
    {
        return $this->hasMany(MerchantPurse::class,'user_id','id');
    }

    public function payer()
    {
        return $this->belongsTo(User::class,'payer_id','id');
    }

    public function payee()
    {
        return $this->belongsTo(User::class,'payee_id','id');
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class,'gateway_id','id');
    }

    public function network()
    {
        return $this->belongsTo(Network::class,'network_id','id');
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class,'rate_id','id');
    }

    protected $casts = [
        'payee_balance' => 'decimal:18',
        'payer_balance' => 'decimal:18',
        'amount' => 'decimal:18',
        'detected_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

}
