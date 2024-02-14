<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'name', 'logo', 'status', 'is_subscribed', 'subscribed_at', 'next_subscription_at'];

    protected $casts = [
        'status'               => 'boolean',
        'is_subscribed'        => 'boolean',
        'subscribed_at'        => 'datetime',
        'next_subscription_at' => 'datetime',
    ];
    public function owner() :BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function domains() :HasMany
    {
        return $this->hasMany(Domain::class, 'merchant_id');
    }
}
