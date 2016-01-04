<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;
use Auth;
use App\Models\UserProfile;
use App\Models\Country;
use App\Models\InitialValue;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {	
        /*view()->composer(['master', 'admin.index'], function($view){
			$user = Auth::user();
			$user_profile = UserProfile::where('user_id', '=', $user->id)->get();
			$view->with( ['user' => $user, 'user_profile' => $user_profile[0], 'date' => date('D, F d Y') ] );
		});*/
		
		view()->composer('*', function($view){
			if (Auth::check()) {
				$user = Auth::user();
				$user_profile = UserProfile::where('user_id', '=', $user->id)->get();
				$initial_values = InitialValue::where('organization_id', '=', $user->organization_id)->first();
				$view->with( ['initial_values' => $initial_values, 'user' => $user, 'user_profile' => $user_profile[0], 'date' => date('D, F d Y')] );
			}
		});
		
		view()->composer('auth.register', function($view){
			$countries = Country::all();
			$view->with( ['countries' => $countries] );
		});
		
		Blade::directive('date', function($expression) {
            return "<?php echo date('d F, Y', strtotime($expression)) ?>";
        });
		
		Blade::directive('datetime', function($expression) {
			return "<?php echo date('d F, Y at H:i:s A', strtotime($expression)) ?>";
        });
		
		Blade::directive('format_number', function($expression) {
			return "<?php echo date('d F, Y at H:i:s A', strtotime($expression)) ?>";
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
