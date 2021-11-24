<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role_id == '3'){
            
            return $next($request);
        }

        return response()->json(['error', "You don't have SuperAdmin access.", 200]);
    }
}
