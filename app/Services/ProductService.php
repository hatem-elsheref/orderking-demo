<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function listAll()
    {
        return Product::query()->with('category')->filter()->search()->paginate(10);
    }
}
