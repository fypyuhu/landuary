<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Http\Requests\ProfileCreate;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Tax;
use App\Models\TaxComponent;
use App\Models\Item;
use App\Models\ItemRelation;
use DB;


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
	
	public function getStep1() {
		$current = array('current', '', '');
		return view('admin.profile.step1.index', [ 'current' => $current ]);
	}
	
	public function getStep2() {
		$current = array('current', 'current', '');
		return view('admin.profile.step2.index', [ 'current' => $current ]);
	}
	
	public function getStep3() {
		$current = array('current', 'current', 'current');
		return view('admin.profile.step3.index', [ 'current' => $current ]);
	}
	
	public function getTaxesShow() {
		$records = Tax::take(1)->get();
        $data = array();
        foreach ($records as $record) {
            $row = array();
			$row["tax_type"] = $record->tax_type;
            $row["tax_name"] = $record->tax_name;
            $row["agency_name"] = $record->agency_name;
            $row["tax_rate"] = $record->tax_rate > 0 ? $record->tax_rate : '';
			$row["actions"] = '<a href="/admin/taxes/edit/'.$record->id.'" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/'.$record->id.'" data-mode="ajax">Delete</a>';
            $data[] = $row;
			
			$components = DB::table('taxes')
            ->join('taxes_components', 'taxes.id', '=', 'taxes_components.tax_id')
            ->select('taxes.*', 'taxes_components.*')
			->where('taxes_components.tax_id', '=', $record->id)
			->where('taxes.tax_type', 'combined')
            ->get();
			
            foreach ($components as $component) {
                $sub_row = array();
				$sub_row["tax_type"] = '--';
				$sub_row["tax_name"] = '--';
                $sub_row["component_name"] = '** '.$component->component_name;
                $sub_row["agency_name"] =$component->agency_name;
                $sub_row["tax_rate"] =$component->tax_rate;
                $sub_row["actions"] = '<a href="/admin/taxes/edit/'.$record->id.'" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/'.$record->id.'" data-mode="ajax">Delete</a>';
                $data[] = $sub_row;
            }
        }
        echo "{\"data\":" . json_encode($data) . "}";
	}
	
	public function getItemsShow() {
		$items = DB::select(DB::raw('SELECT * FROM `items` where id not in (select child_id from item_relation) AND items.status=1 LIMIT 1'));
        $data = array();
        foreach ($items as $item) {
            $row = array();
            $row["name"] = $item->name;
            $row["item_number"] = $item->item_number;
            $row["status"] = '1';
            $row["weight"] = $item->weight;
            $row["transaction_type"] = $item->transaction_type;
            $row["actions"] = '<a href="/admin/items/edit/' . $item->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/items/delete/' . $item->id . '" data-mode="ajax">Delete</a>';
            $data[] = $row;
            $sql = "select items.* from items join item_relation on items.id=item_relation.child_id where items.status=1 AND item_relation.parent_id='" . $item->id . "'";
            $sub_items = DB::select(DB::raw($sql));
            foreach ($sub_items as $sub_item) {
                $sub_row = array();
                $sub_row["name"] = $sub_item->name;
                $sub_row["item_number"] = $sub_item->item_number;
                $sub_row["status"] = '0';
                $sub_row["weight"] = $sub_item->weight;
                $sub_row["transaction_type"] = $sub_item->transaction_type;
                $sub_row["actions"] = '<a href="/admin/items/edit/' . $sub_item->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/items/delete/' . $sub_item->id . '" data-mode="ajax">Delete</a>';
                $data[] = $sub_row;
            }
        }
        echo "{\"data\":" . json_encode($data) . "}";
	}
	
	public function getCustomersShow() {
		$records = Customer::take(1)->get();
        $data = array();
        foreach ($records as $record) {
            $row = array();
            $row["name"] = $record->name;
            $row["number"] = $record->customer_number;
            $row["phone"] = $record->shipping_phone;
            $row["actions"] = '<a href="/admin/customers/edit/' . $record->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/customers/delete/' . $record->id . '" data-mode="ajax">Delete</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
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
