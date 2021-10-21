<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $role)
    {
        if( auth()->user() && auth()->user()->role == $role){
            // if(1==1){
            // dd(auth()->user());
            return $next($request);
        }
        abort(404, 'trang khong tim thay');
    }
}
