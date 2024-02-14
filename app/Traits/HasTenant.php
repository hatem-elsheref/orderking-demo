<?php

namespace App\Traits;
use App\Models\Scopes\TenantScope;

trait HasTenant
{
    public function scopeMerchant($query) :void
    {
        $query->withoutGlobalScope(TenantScope::class)->where('merchant_id', config('merchant_id'));
    }
}
