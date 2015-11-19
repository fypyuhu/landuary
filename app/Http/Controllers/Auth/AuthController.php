<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
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
	
	public function postRegister(Request $request) {
		$user = $this->create($request->all());
		
		$up = new UserProfile;
		$up->user_id = $user->id;
		$up->legal_name = $request['legal_name'];
		$up->street_address = $request['street_address'];
		$up->city = $request['city'];
		$up->state = $request['state'];
		$up->zipcode = $request['zipcode'];
		$up->country = $request['country'];
		$up->phone = $request['phone'];
		$up->fax = $request['fax'];
		$up->email = $request['email'];
		$up->website = $request['website'];
		$up->contact_name = $request['contact_name'];
		$up->contact_designation = $request['contact_designation'];
		$up->contact_email = $request['contact_email'];
		$up->save();
		
		//return response()->view('registerSuccess', $request->all());
		return redirect()->route('success');
	}
	
	public function getSuccess() {
		return view('registerSuccess');
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {	
        /*return User::create([
            'first_name' => $data['legal_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
		
		return User::create([
            'first_name' => $data['legal_name'],
            'email' => $data['email']
        ]);
    }
}
