<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Request;

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
		$url = Request::url();
		if(intval($visited) <= 0) {
			if(strpos($url, 'step') !== false) {
				$current_step = intval(substr($url, -1));
				return redirect('/admin/profile/step'.$current_step);
			} else if(strpos($url, 'step') === false && strpos($url, 'profile') !== false)
				return redirect('/admin/profile');
		}
		
        return $next($request);
    }
}
