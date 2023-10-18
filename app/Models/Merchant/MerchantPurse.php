<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantPurse extends Model
{

    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'merchant_purses';

    protected $fillable=['user_id', 'purse_id','merchant_id','percentage', 'fee'];

    protected $casts=[
        'percentage'=>'decimal:2',
        'fee'=>'decimal:2'
    ];
}
