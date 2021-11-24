<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUser
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role_id == '3'){
            
            return $next($request);
        }
        if(Auth::user()->role_id == '2'){
            
            return $next($request);
        }
        if(Auth::user()->role_id == '1'){
            
            return $next($request);
        }

        return response()->json(['error', "You need to register before come here.", 200]);
    }
}
