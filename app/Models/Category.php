<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'is_active'];


    public function parent() :BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function subCategories() :HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function activeScope($query)
    {
        return $query->where('is_active', true);
    }
}
