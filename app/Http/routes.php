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

Route::get('/', ['middleware' => 'guest', ['except' => 'getLogout'], function () {
	return view('welcome');
}]);
Route::get('setUserPassword', 'SetUserPasswordController@getIndex');
Route::post('setUserPassword/edit', 'SetUserPasswordController@postEdit');
Route::get('/logout', function () {
    Auth::logout();
    return view('welcome');
});
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['middleware' => 'auth', 'middleware' => 'verify.steps.completed'], function () {
	Route::controller('admin/profile', 'UserProfileController');
});

Route::get('admin', ['middleware' => 'auth', 'middleware' => 'profile.completed']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::controller('items', 'ItemController');
    Route::controller('carts', 'CartController');
    Route::controller('customers', 'CustomerController');
    Route::controller('taxes', 'TaxController');
    Route::controller('out', 'OutController');
    Route::controller('in', 'InController');
    Route::controller('receiving-manifest', 'ReceivingManifestController');
    Route::controller('shiping-manifest', 'ShipmentController');
    Route::controller('manifests', 'ManifestController');
    Route::controller('carts-list', 'CartsListController');
	Route::controller('invoices', 'InvoiceController');
	Route::controller('rewash', 'RewashController');
    Route::controller('/', 'HomeController');
});