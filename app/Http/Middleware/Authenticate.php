<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return null|string
     */

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard('api')->guest()) {
            throw new \Exception('Unauthorized', 401);
        }
        return $next($request);
    }
}
