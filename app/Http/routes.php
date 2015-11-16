<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['middleware' => 'guest', ['except' => 'getLogout'], function () {
    return view('welcome');
}]);
Route::get('/logout', function () {
    Auth::logout();
});
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
	Route::controller('items', 'ItemController');
	Route::controller('carts', 'CartController');
        Route::controller('customers', 'CustomerController');
	Route::controller('taxes', 'TaxController');
	Route::controller('out', 'OutController');
        Route::controller('shiping-manifest', 'ShipmentController');
	Route::controller('profile', 'UserProfileController');
});
