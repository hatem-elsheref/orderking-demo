<?php

namespace App\Models\Scopes;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserTenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (config('merchant_id') && !config('is_merchant')){
            $builder->where('merchant_id', config('merchant_id'))->where('type', RoleType::CUSTOMER->value);
        }else{
            $builder->when(config('is_merchant'), function ($query){
                $query->whereNull('merchant_id')->where('type', RoleType::STORE->value)->whereHas('stores', function ($query){
                    $query->whereHas('domains', function ($query){
                        $query->where('domain', config('merchant_domain'));
                    });
                });
            },
                fn($query) => $query->whereNull('merchant_id')->where('type', RoleType::ADMIN->value));
        }
    }
}
