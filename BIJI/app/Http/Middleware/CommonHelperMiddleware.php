<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CommonHelperMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('jwt_token') && session()->has('seed') && session()->has('paramId')) {
            return redirect('/'); 
        }

        return $next($request);
    }
}

