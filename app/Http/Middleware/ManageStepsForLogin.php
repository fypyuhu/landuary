<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Organization;
use Auth;
use Request;

class ManageStepsForLogin
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
			$org_id = Auth::user()->organization_id;
			$org = Organization::where('id', '=', $org_id)->first();
			$url = Request::url();
			if(strpos($url, 'step') === false && strpos($url, 'initial-values') === false) {
				$skipped_at = intval($org->profile_skipped_at_step);
				$current_step = intval(substr($url, -1));
				if( $skipped_at > 0 && $skipped_at < 5 && $skipped_at != $current_step ) {
					return redirect('admin/profile/step'.$org->profile_skipped_at_step);
				}
			}
		}
		
		return $next($request);
    }
}
