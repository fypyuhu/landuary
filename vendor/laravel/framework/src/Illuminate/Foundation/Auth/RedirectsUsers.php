<?php

namespace Illuminate\Foundation\Auth;
use Auth;
use App\Models\InitialValue;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
			$visited = Auth::user()->visited;
			
			echo $this->redirectPath;
			DD($visited);
			
			if($visited > 0) {
				echo "a"; dd();
            	return '/admin';
			} else {
				echo "b"; dd();
				return $this->redirectPath;
			}
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
