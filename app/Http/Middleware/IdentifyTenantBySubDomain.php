<?php

namespace App\Http\Middleware;

use App\Models\Domain;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenantBySubDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subDomain = str_replace('.'.config('app.central_domain'),'', $request->host());

        $merchant  = Domain::query()->with('merchant', function ($query){
            $query->where('status', true)->where('is_subscribed', true);
        })->where('domain', $subDomain)->first();

        if (!$merchant) abort(404, 'This Domain Not Registered Yet!!');

        if (!$merchant->merchant) abort(403, 'Please Contact With Support To Check Your Subscription!!');

        config()->set('merchant_id', $merchant->merchant_id);

        return $next($request);
    }
}
