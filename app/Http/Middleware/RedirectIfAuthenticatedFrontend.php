<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticatedFrontend
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('token')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}