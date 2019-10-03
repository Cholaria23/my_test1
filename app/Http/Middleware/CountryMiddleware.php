<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CountryMiddleware
{
    public function handle($request, Closure $next)
    {
        if($request->hasCookie('country_id')) {
            return $next($request);
        }

        if ($request->has('country_id')) {
            $country_id = $request->get('country_id');
            $response = $next($request);
            return $response->withCookie(cookie()->forever('country_id', $country_id));
        }

        $response = $next($request);
        return $response->withCookie(cookie()->forever('country_id', 1)); // Remove hardcode
    }
}
