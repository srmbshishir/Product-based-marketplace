<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BuyerCheck
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
        if($request->session()->has('type') == 'buyer'){
            return $next($request);
        }else{
            return redirect()->route('/Buyer/index');
        }
    }
}
