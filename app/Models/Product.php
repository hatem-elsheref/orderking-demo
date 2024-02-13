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

    public function searchScope($query) :BelongsTo
    {
        $keyword = request()->query('search');
        return $query->when(!empty($keyword), function ($query) use ($keyword){
            return $query->where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('tags', 'LIKE', "%$keyword%");
        });
    }

    public function searchFilter($query) :BelongsTo
    {
        $category = request()->query('category');
        return $query->when(!empty($category), function ($query) use ($category){
            return $query->whereIn('category_id', explode(',', $category));
        });
    }

    public function getImageAttribute() :string
    {
        return '';
    }
}
