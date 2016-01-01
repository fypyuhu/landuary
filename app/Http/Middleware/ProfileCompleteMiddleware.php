<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Request;
use Auth;
use URL;

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
			if(intval($visited) <= 0) {
				/*if(null !== URL::previous())
					return redirect(URL::previous());
				else 
					return redirect('admin/profile');*/
				return redirect('admin/profile/step1');
			}
		}

        return $next($request);
    }
}
