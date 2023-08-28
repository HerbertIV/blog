<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->guest() && ! $request->expectsJson()) {
            return redirect()->route('admin-login');
        }

        return $next($request);
    }
}
