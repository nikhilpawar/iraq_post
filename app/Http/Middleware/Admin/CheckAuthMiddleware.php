<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Sentinel;


class CheckAuthMiddleware
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
        $obj_user = Sentinel::check();
        
        if($obj_user!=false)
        {
            return redirect(url('/admin/dashboard')); 
        }
        
        return $next($request);
    }
   
}
