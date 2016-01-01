<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class SetUserPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('setUserPassword');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
		if($user) {
			$user->password = bcrypt($request->password);
			$user->save();
			
			$to = $request->email;
			$subject = "Password Notification";
			$message = "Dear ".$request->legal_name.",<br /><br />Your password for LaundryTek account has been created. Please use following information to login:<br /><br />
			<strong>Email:</strong> ".$request->email."<br />
			<strong>Password:</strong> ".$request->password."<br />
			<br />Thanks,<br />Team LaundryTek Systems";
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "To: ".$request->legal_name." <".$to.">" . "\r\n";
			$headers .= "From: Laundrytek Systems <info@laundrytek.com>" . "\r\n";
			
			mail($to,$subject,$message,$headers);
			
			return redirect('setUserPassword')->with('status', 'Entered password for the specified email has been saved.');
		} else {
			return redirect('setUserPassword')->with('status', 'Entered email address does not exists in our records. Please enter valid email address and try again.');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
