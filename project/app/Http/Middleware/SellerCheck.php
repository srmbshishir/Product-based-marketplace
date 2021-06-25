<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SellerCheck
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
        if($request->session()->has('type') == 'seller'){
            return $next($request);
        }else{
            return redirect()->route('/seller/index');
        }
    }
}
