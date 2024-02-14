<?php

namespace App\Models;

use App\Enums\RoleType;
use App\Models\Scopes\TenantScope;
use App\Traits\HasTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasTenant;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'role_id',
        'merchant_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status'   => 'boolean'
    ];

    public function merchant() :BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function stores() :HasMany
    {
        return $this->hasMany(Merchant::class, 'owner_id');
    }

    public function isMerchant() :bool
    {
        return $this->type === RoleType::STORE->value;
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());
    }
}
