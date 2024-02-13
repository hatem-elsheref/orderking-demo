<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'tags', 'picture'];

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function imageScope() :string
    {
        return '';
    }
}
