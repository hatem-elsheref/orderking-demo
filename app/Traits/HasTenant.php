<?php


namespace App\Traits;

use App\Models\Scopes\TenantScope;

trait HasTenant
{
    public function scopeTenant($query) :void
    {
        $query->withoutGlobalScopes()->withGlobalScope('tenant', new TenantScope());
    }

}
