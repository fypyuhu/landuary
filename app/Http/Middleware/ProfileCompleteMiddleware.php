<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class ProfileCompleteMiddleware
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
		$visited = Auth::user()->visited;	
		if(intval($visited) <= 0) {
			//return redirect()->back();
		}
		
        return $next($request);
    }
}
