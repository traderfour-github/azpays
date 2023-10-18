<?php

namespace App\Models\Purse;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purse extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'purses';

    protected $fillable = [
        'name', 'currency', 'note', 'status', 'address', 'type', 'public_key',
        'private_key', 'signature', 'color', 'balance', 'freeze', 'locked',
    ];

    protected $hidden=['type', 'public_key','private_key','signature'];

    public function purseUser(): HasOne
    {
        return $this->hasOne(PurseUser::class,'purse_id','id');
    }
}
