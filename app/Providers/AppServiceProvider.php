<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Models\UserProfile;
use App\Models\Country;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {	
        view()->composer(['master', 'admin.index'], function($view){
			$user = Auth::user();
			$user_profile = UserProfile::where('user_id', '=', $user->id)->get();
			$view->with( ['user' => $user, 'user_profile' => $user_profile[0], 'date' => date('D, F d Y') ] );
		});
		
		view()->composer('auth.register', function($view){
			$countries = Country::all();
			$view->with( ['countries' => $countries] );
		});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
