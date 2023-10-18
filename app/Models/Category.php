<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'type'
    ];

    public function merchants(): MorphToMany
    {
        return $this->morphedByMany(Merchant::class, 'categorizable');
    }
}
