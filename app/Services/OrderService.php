<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    public function total() :int
    {
        return Order::query()->count();
    }

    public function paginate($length = 5) :LengthAwarePaginator
    {
        return Order::query()->with(['customer' => fn($query) => $query->withoutGlobalScopes(), 'merchant'])->paginate($length);
    }
}
