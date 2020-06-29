<?php

namespace App\Http\Middleware;

use App\User; //2020.06.29

use Closure;

class AdminAuth
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
        if (auth()->check() && auth()->user()->admin =='admin'){
            
            return $next($request);
        }
       // return $next($request);
       return redirect('/home');
    }
}
