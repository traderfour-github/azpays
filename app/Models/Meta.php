<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable=['key','value'];

    public function metaable()
    {
        return $this->morphTo();
    }

}
