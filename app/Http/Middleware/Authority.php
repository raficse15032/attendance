<?php

namespace App\Http\Middleware;

use Closure;

use Sentinel;

class Authority
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
        if(Sentinel::getUser()){
            if(Sentinel::getUser()->status == 1){
                return $next($request);
            }
        }
        return redirect('/login');
    }
}
