<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\UserProfile;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectPath = '/admin/profile';
    protected $loginPath = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
			'legal_name' => 'required|max:255',
			'street_address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zipcode' => 'required',
			'country' => 'required',
			'phone' => 'required',
			'fax' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'website' => 'required',
			'contact_name' => 'required',
			'contact_designation' => 'required',
			'contact_email' => 'required|email|max:255',
            //'name' => 'required|max:255',
            //'email' => 'required|email|max:255|unique:users',
            //'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		$u = new User;
		$u->first_name = $data['legal_name'];
		$u->email = $data['email'];
		$u->save();
		
		$up = new UserProfile;
		$up->user_id = $u->id;
		$up->legal_name = $data['legal_name'];
		$up->street_address = $data['street_address'];
		$up->city = $data['city'];
		$up->state = $data['state'];
		$up->zipcode = $data['zipcode'];
		$up->country = $data['country'];
		$up->phone = $data['phone'];
		$up->fax = $data['fax'];
		$up->email = $data['email'];
		$up->website = $data['website'];
		$up->contact_name = $data['contact_name'];
		$up->contact_designation = $data['contact_designation'];
		$up->contact_email = $data['contact_email'];
		$up->save();
		return response()->view('registerSuccess', $data);
		
        /*return User::create([
            'first_name' => $data['legal_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
    }
}
