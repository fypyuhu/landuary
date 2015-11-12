<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Http\Requests\ProfileCreate;
use App\Models\Country;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$countries = Country::all();
        return view('admin.profile.index', ['countries'=>$countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(ProfileCreate $request)
    {	
		$up = new UserProfile;
		$up->user_id = $request->user_id;
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
		$up->tax_id_number = $request->tax_id_number;
		
		if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
			$fileName = time() . $request->file('logo')->getClientOriginalName(); // getting image extension
			$destinationPath = public_path() . "/uploads/profile";
			$request->file('logo')->move($destinationPath, $fileName);
			$up->logo = $fileName;
		}
		
		$up->contact_name = $request->contact_name;
		$up->contact_designation = $request->contact_designation;
		$up->contact_email = $request->contact_email;
		/*$up->linen_rental = $request->linen_rental;
		$up->healthcare = $request->healthcare;
		$up->hospitality = $request->hospitality;
		$up->vacational_rentals = $request->vacational_rentals;
		$up->customer_own_goods = $request->customer_own_goods;*/
		$up->save();
		return redirect()->route('admin/profile/view');
    }
	
	public function getView(Request $request) {
		$user_id = isset($request->user_id) ? $request->user_id : 2;
		$user_profile = UserProfile::where('user_id', '=', $user_id)->get();
		$countries = Country::all();
		return view('admin.profile.view', [ 'user' => $user_profile[0], 'countries' => $countries ]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEdit($id, ProfileCreate $request)
    {
		$up = UserProfile::find($id);
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
		$up->tax_id_number = $request->tax_id_number;
		
		if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
			$fileName = time() . $request->file('logo')->getClientOriginalName(); // getting image extension
			$destinationPath = public_path() . "/uploads/profile";
			$request->file('logo')->move($destinationPath, $fileName);
			$up->logo = $fileName;
		}
		
		$up->contact_name = $request->contact_name;
		$up->contact_designation = $request->contact_designation;
		$up->contact_email = $request->contact_email;
		/*$up->linen_rental = $request->linen_rental;
		$up->healthcare = $request->healthcare;
		$up->hospitality = $request->hospitality;
		$up->vacational_rentals = $request->vacational_rentals;
		$up->customer_own_goods = $request->customer_own_goods;*/
		$up->save();
		return $this->getAjaxForm($request->user_id);
    }
	
	public function getAjaxForm($user_id) {
		$user_profile = UserProfile::where('user_id', '=', $user_id)->get();
		$countries = Country::all();
		return view('admin.profile.ajaxForm', [ 'user' => $user_profile[0], 'countries' => $countries ]);
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
    public function edit($id)
    {
        //
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
