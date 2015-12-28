<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Register;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\UserProfile;
use App\Models\Organization;
use App\Models\InitialValue;

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
    /*protected function validator(array $data)
    {
        return Validator::make($data, [
			'legal_name' => 'required|max:255',
			'street_address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zipcode' => 'required',
			'country' => 'required',
			'phone' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'contact_name' => 'required',
			'contact_designation' => 'required',
			'contact_email' => 'required|email|max:255',
            //'name' => 'required|max:255',
            //'email' => 'required|email|max:255|unique:users',
            //'password' => 'required|confirmed|min:6',
        ]);
    }*/
	
	public function postRegister(Register $request) {
		$org = new Organization;
		$org->name = $request->legal_name;
		$org->save();
		
		$iv = new InitialValue;
		$iv->organization_id = $org->id;
		$iv->save();
		
		$u = new User;
		$u->first_name = $request->legal_name;
		$u->email = $request->email;
		$u->organization_id = $org->id;
		$u->save();
		
		$up = new UserProfile;
		$up->user_id = $u->id;
		$up->legal_name = $request->legal_name;
		$up->street_address = $request->street_address;
		$up->city = $request->city;
		$up->state = $request->state;
		$up->zipcode = $request->zipcode;
		$up->country = $request->country;
		$up->phone = $request->phone;
		$up->fax = $request->fax;
		$up->email = $request->email;
		$up->website = $request->website;
		$up->contact_name = $request->contact_name;
		$up->contact_designation = $request->contact_designation;
		$up->contact_email = $request->contact_email;
		$up->save();
		
		$to = $request->email;
		$subject = "Registration Notification";
		$message = "Dear ".$request->legal_name."<br /><br />Congratulations! You have successfully registered with LaundryTek Systems. A sales representative will shortly be in touch with you to complete your software setup. We look forward to working with you.<br /><br />Thanks,<br />Team LaundryTek Systems Admin";
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "To: ".$request->legal_name." <".$to.">" . "\r\n";
		$headers .= "From: Laundrytek Systems <info@laundrytek.com>" . "\r\n";
		mail($to,$subject,$message,$headers);
		
		$to = 'ubaidkhan.se@gmail.com';
		$subject = "Registration Notification";
		$message = "Dear Admin,<br /><br />A new user has been registered with LaundryTek with following information:<br /><br />
		<strong>Legal Name:</strong> ".$request->legal_name."
		<strong>Street Address:</strong> ".$request->street_address."<br />
		<strong>City:</strong> ".$request->city."<br />
		<strong>State:</strong> ".$request->state."<br />
		<strong>Zipcode:</strong> ".$request->zipcode."<br />
		<strong>Country:</strong> ".$request->country."<br />
		<strong>Phone:</strong> ".$request->phone."<br />
		<strong>Fax:</strong> ".$request->fax."<br />
		<strong>Email:</strong> ".$request->email."<br />
		<strong>Website:</strong> ".$request->website."<br />
		<strong>Contact Name:</strong> ".$request->contact_name."<br />
		<strong>Contact Designation:</strong> ".$request->contact_designation."<br />
		<strong>Contact Email:</strong> ".$request->contact_email."<br />
		<br /><br />Thanks,<br />Team LaundryTek Systems Admin";
		
		$headers .= "To: Laundrytek Systems <".$to.">" . "\r\n";
		mail($to,$subject,$message,$headers);
		
		return response()->view('registerSuccess', $request->all());
		//return redirect('/registerSuccess');
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
        return User::create([
            'first_name' => $data['legal_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
