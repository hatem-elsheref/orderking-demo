<?php

namespace App\Models;

use App\Enums\RoleType;
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'merchant_id', 'status', 'description', 'amount', 'tax'];

    public function customer() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->where('type', RoleType::CUSTOMER->value);
    }

    public function merchant() :BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());
    }
}
