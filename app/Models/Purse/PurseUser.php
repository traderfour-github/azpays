<?php

namespace App\Models\Purse;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurseUser extends Model
{

    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'purse_users';

    protected $fillable=['user_id','purse_id','percentage','signature','daily_limit'];

    protected $casts=[
        'percentage'=>'decimal:2'
    ];
}
