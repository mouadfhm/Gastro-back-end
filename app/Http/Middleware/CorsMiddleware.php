<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Max-Age', '1800');
        $response->headers->set('Access-Control-Allow-Headers', 'content-type, x-requested-with');
        $response->headers->set('Access-Control-Allow-Methods', 'PUT, POST, GET, DELETE, PATCH, OPTIONS');

        return $response;
    }
}
