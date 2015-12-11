<?php

namespace App\Http\Middleware;
use App\Models\Organization;
use Auth;
use Request;
use Closure;

class ManageStepsForLogin
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
		$org_id = Auth::user()->organization_id;
		$org = Organization::where('id', '=', $org_id)->first();
		$url = Request::url();
		if(strpos($url, 'step') === false && strpos($url, 'initial-values') === false) {
			$skipped_at = intval($org->profile_skipped_at_step);
			$current_step = intval(substr($url, -1));
			if( $skipped_at > 0 && $skipped_at < 5 && $skipped_at > $current_step) {
				return redirect('admin/profile/step'.$org->profile_skipped_at_step);
			}
		}
		
		return $next($request);
    }
}
