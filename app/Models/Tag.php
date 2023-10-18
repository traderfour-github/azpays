<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'tags';

    protected $fillable = [
        'title',
    ];

    public function merchants(): MorphToMany
    {
        return $this->morphedByMany(Merchant::class, 'taggable');
    }
}
