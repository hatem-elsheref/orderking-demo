<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'merchant_id', 'is_core'];

    protected $casts = [
        'is_core' => 'boolean'
    ];
    public function merchant() :BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function permissions() :BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_roles','role_id', 'permission_id');
    }
}
