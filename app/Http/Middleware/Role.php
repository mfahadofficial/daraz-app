<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class role
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
       echo (Auth::user()->role_id);
        if(Auth::user()->role_id == "2"){
            // return response()->json('user', Auth::user(), 200);
            return $next($request);
        }
        // Auth::user()->organizationUser->hasRole('owner')

        // if(Auth::user()->role_id == 2){
        //     return $next($request);
        // }

        // else if(Auth::user()->role_id == 3){
        //     return $next($request);
        // }
        // return $next($request);
        return response()->json('error',"You don't have admin access.", 200);
        // return redirect(‘home’)->with(‘error’,"You don't have admin access.");
    }
}
