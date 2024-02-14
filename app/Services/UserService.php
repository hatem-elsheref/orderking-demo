<?php

namespace App\Services;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function total($type = RoleType::CUSTOMER) :int
    {
        return User::query()->tenant()->where('type', $type->value)->count();
    }

    public function listingCustomers($length = 5) :LengthAwarePaginator
    {
        return User::query()->tenant()->customer()->with('merchant')->paginate($length);
    }

    public function listingMerchants($length = 5) :LengthAwarePaginator
    {
        return User::query()->tenant()->merchant()->with('store.domain')->paginate($length);
    }

    public function listingAdmins($length = 5) :LengthAwarePaginator
    {
        return User::query()->tenant()->admin()->with('role')->paginate($length);
    }

}
