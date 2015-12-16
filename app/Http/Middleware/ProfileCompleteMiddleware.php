<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Request;
use Auth;

class ProfileCompleteMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/');
            }
        } else if ($this->auth->check()) {
			$visited = Auth::user()->visited;
			$url = Request::url();
			if(intval($visited) <= 0) {
				if(strpos($url, 'step') !== false) {
					$current_step = intval(substr($url, -1));
					return redirect('/admin/profile/step'.$current_step);
				} else if(strpos($url, 'step') === false && strpos($url, 'profile') !== false)
					return redirect('/admin/profile');
			}
		}

        return $next($request);
    }
}
