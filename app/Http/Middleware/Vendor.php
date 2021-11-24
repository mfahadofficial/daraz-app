<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Vendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        if(Auth::user()->role_id == '3'){
            
            return $next($request);
        }

        if(Auth::user()->role_id == '2'){
            
            return $next($request);
        }

        return response()->json(['error', "You don't have Vendor access.", 200]);
    }
}
