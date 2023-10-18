<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasUuids, HasFactory, Notifiable, SoftDeletes;

    const TABLE = 'users';

    const ID = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'mobile',
        'phone_number',
        'country',
        'language',
        'timezone',
        'referrer_id',
        'joined_friends',
        'last_connection',
        'private',
        'latitude',
        'longitude',
        'avatar',
        'status',
    ];

    public function settings()
    {
        return $this->hasMany(UserSetting::class);
    }

    public function userNotificationSettings()
    {
        return $this->hasMany(UserNotificationSetting::class);
    }

    public function usrSecurities()
    {
        return $this->hasMany(UserSecurity::class);
    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    protected $casts = [
        'balance' => 'decimal:18',
        'private' => 'boolean',
    ];

    public function gateways(): HasMany
    {
        return $this->hasMany(Gateway::class, Gateway::USER_ID, self::ID);
    }
}
