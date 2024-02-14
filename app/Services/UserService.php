<?php

namespace App\Services;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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

    public function listingAllCustomers($request) :array
    {
        $columns = [
            'id',
            'name',
            'email'
        ];
        $keyword = $request->search['value'];
        $query = User::query()->tenant()->customer();
        $totalRecords = $query->count();

        $data = $query->with('merchant')
            ->when(!empty($keyword), function ($query) use ($keyword){
                $query->where('name', 'LIKE', "%.$keyword.%")
                      ->orWhere('email', 'LIKE', "%.$keyword.%");
            })->orderBy($columns[$request->order[0]['column']] ?? 'id', $request->order[0]['dir'] ?? 'desc')
            ->skip($request->start)->take($request->length)->get();

        return [
            'data' => $data,
            'totalRecordWithFilter' => count($data),
            'totalRecords' => $totalRecords
        ];
    }

    public function listingCustomersOf($merchant, $length = 5) :LengthAwarePaginator
    {
        return User::query()->tenant()->customer()->where('merchant_id', $merchant->id)->with('merchant')->paginate($length);
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
