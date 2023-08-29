<?php

namespace App\Http\Middleware;

use App\Enums\GuardEnums;
use Closure;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->guard(GuardEnums::ADMIN)->guest() && ! $request->expectsJson()) {
            return redirect()->route('admin-login');
        }

        return $next($request);
    }
}
