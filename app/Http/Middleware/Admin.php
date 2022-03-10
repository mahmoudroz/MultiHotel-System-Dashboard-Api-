<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->guest()){
            return redirect('/login');
        }
        else if(auth()->user()->type == 0){
            return redirect('/');
        }
        return $next($request);
    }
}
