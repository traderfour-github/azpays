<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'merchants';

    protected $fillable=['name','logo','status', 'tell','domain','ip',
        'webhook', 'callback', 'description',
        'support_email','support_phone','support_url','color'
    ];

    public function merchantUser()
    {
        return $this->hasMany(MerchantPurse::class,'merchant_id','id');
    }

    public function merchantPurse()
    {
        return $this->hasMany(MerchantPurse::class,'purse_id','id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
