<?php

namespace App\Models;

use Couchbase\Role;
use Fouladgar\OTP\Contracts\OTPNotifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $string, mixed $email)
 * @method static create(array $array)
 * @property mixed $password
 * @property mixed $id
 * @property mixed $phone
 */
class User extends Authenticatable implements OTPNotifiable
{
    use HasApiTokens,HasFactory, Notifiable;
    const ROLE_CUSTOMER = 'customer';
    const ROLE_KITCHEN = 'kitchen';
    const ROLE_ADMIN = 'admin';
    public const statuses = ['NEW', 'UNVERIFIED', 'ACTIVE', 'SUSPENDED'];
    public const status_new = 'NEW';
    public const status_unverified = 'UNVERIFIED';
    public const status_active = 'ACTIVE';
    public const status_suspended = 'SUSPENDED';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'remember_token',
        'role'

    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role'
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role): bool
    {
        return $this->role === $role;
    }
    public function fcm(): HasMany
    {
        return $this->hasMany(UserFcm::class);
    }    public function kitchen(): HasMany
    {
        return $this->hasMany(Kitchen::class);
    }
    public function toLightWeightArray(): array
    {
        return $this->toArray();
    }
    public function routeNotificationForFcm(): string
    {
        $token=$this->fcm()->first();
        return $token->fcm;
    }


    public function sendOTPNotification(string $token, array $channel): void
    {
        // TODO: Implement sendOTPNotification() method.
    }

    public function getMobileForOTPNotification(): string
    {
        return $this->phone;
        // TODO: Implement getMobileForOTPNotification() method.
    }

    public function routeNotificationForOTP(): string
    {
        // TODO: Implement routeNotificationForOTP() method.
        return 0;
    }

    public function resetToken(): HasOne
    {
        return $this->hasOne(PasswordResetToken::class, 'email', 'email');
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
}
