<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureTwoFactorIsVerified
{
    public function handle($request, Closure $next)
    {
        if (!session('2fa_passed')) {
            return redirect()->route('2fa.challenge');
        }

        return $next($request);
    }

}
