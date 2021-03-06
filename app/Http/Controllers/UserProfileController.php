<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Http\Requests\ProfileCreate;
use App\Http\Requests\ResetPassword;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Tax;
use App\Models\TaxComponent;
use App\Models\Item;
use App\Models\ItemRelation;
use App\Models\InitialValue;
use App\Models\Organization;
use Hash;
use DB;
use Auth;

class UserProfileController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request) {
        $user = $request->user();
        $user_id = $user->id;
        $user_profile = UserProfile::where('user_id', '=', $user_id)->first();
        $countries = Country::all();
		$visited = intval($user->visited);
        return view('admin.profile.index', ['countries' => $countries, 'user' => $user_profile, 'visited' => $visited]);
    }
	
	public function getUser() {
		return view('admin.profile.users.index');
	}
	
	public function getUserCreate()
	{
		return view('admin.profile.users.add');
	}
	
	public function postUserCreate(Request $request)
    {
        //
    }
	
	public function getUserShow(Request $request) {
		$search_filter = '';
		
		if ($request->has('search_string')) {
			$search_filter = " (machine_name like '%$request->search_string%' or machine_number = '$request->search_string') AND ";
		}
			
        //$records = Rule::All();
		$records = array(
				array('user_type' => 'Driver', 'user_id' => '35689', 'user_password' => 'welcome1')
		);
		
        $data = array();
        foreach ($records as $key => $record) {
            $row = array();
			$row["user_type"] = $record['user_type'];
            $row["user_id"] = $record['user_id'];
            $row["user_password"] = $record['user_password'];
            //$row["actions"] = '<a href="/production/machine/edit/' . $key . '" data-mode="ajax" >Edit</a> / <a href="/production/machine/delete/' . $key . '" data-mode="ajax">Delete</a>';
			
			$data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(ProfileCreate $request) {
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
		$up->we_serve = implode(', ', $request->we_serve);
		$up->we_do = implode(', ', $request->we_do);
        $up->save();
        return redirect()->route('admin/profile/view');
    }

    public function postEditProfile($id, ProfileCreate $request) {
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
        $up->we_serve = implode(', ', $request->we_serve);
		$up->we_do = implode(', ', $request->we_do);
        $up->save();
		
		if($this->skippedAt() <= 0) {
			$org_id = Auth::user()->organization_id;
			$org = Organization::find($org_id);
			$org->profile_skipped_at_step = 1;
			$org->save();
		}
		
        return redirect('admin/profile/step1');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEdit($id, ProfileCreate $request) {
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
        $up->we_serve = implode(', ', $request->we_serve);
		$up->we_do = implode(', ', $request->we_do);
        $up->save();
        return $this->getAjaxForm($request->user_id);
    }

    public function getAjaxForm($user_id) {
        $user_profile = UserProfile::where('user_id', '=', $user_id)->get();
        $countries = Country::all();
        return view('admin.profile.ajaxForm', [ 'user' => $user_profile[0], 'countries' => $countries]);
    }
	
	private function skippedAt() {
		$org_id = Auth::user()->organization_id;
		$org = Organization::where('id', '=', $org_id)->first();
		return intval($org->profile_skipped_at_step);
	}

    public function getStep1() {
		if($this->skippedAt() < 1) {
			$org_id = Auth::user()->organization_id;
			$org = Organization::find($org_id);
			$org->profile_skipped_at_step = 1;
			$org->save();
		}
	
        $current = array('current', '', '', '');
        return view('admin.profile.step1.index', [ 'current' => $current]);
    }

    public function getStep2() {
		if($this->skippedAt() < 2) {
			$org_id = Auth::user()->organization_id;
			$org = Organization::find($org_id);
			$org->profile_skipped_at_step = 2;
			$org->save();
		}
		
        $current = array('current', 'current', '', '');
        return view('admin.profile.step2.index', [ 'current' => $current]);
    }

    public function getStep3() {
		if($this->skippedAt() < 3) {
			$org_id = Auth::user()->organization_id;
			$org = Organization::find($org_id);
			$org->profile_skipped_at_step = 3;
			$org->save();
		}
		
        $current = array('current', 'current', 'current', '');
        return view('admin.profile.step3.index', [ 'current' => $current]);
    }

    public function getStep4() {
		if($this->skippedAt() < 4) {
			$org_id = Auth::user()->organization_id;
			$org = Organization::find($org_id);
			$org->profile_skipped_at_step = 4;
			$org->save();
		}
		
        $current = array('current', 'current', 'current', 'current');
        $user = Auth::user();
        $iv_id = InitialValue::where('organization_id', '=', $user->organization_id)->first();
        return view('admin.profile.step4.index', [ 'current' => $current, 'iv_id' => $iv_id]);
    }

    public function getTaxesShow() {
        $records = Tax::organization()->get();
        $data = array();
        foreach ($records as $record) {
            $row = array();
            $row["tax_type"] = $record->tax_type;
            $row["tax_name"] = $record->tax_name;
            $row["agency_name"] = $record->agency_name;
            $row["tax_rate"] = $record->tax_rate > 0 ? $record->tax_rate : '';
            $row["actions"] = '<a href="/admin/taxes/edit/' . $record->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/' . $record->id . '" data-mode="ajax">Delete</a>';
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
                $sub_row["component_name"] = '** ' . $component->component_name;
                $sub_row["agency_name"] = $component->agency_name;
                $sub_row["tax_rate"] = $component->tax_rate;
                $sub_row["actions"] = '<a href="/admin/taxes/edit/' . $record->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/' . $record->id . '" data-mode="ajax">Delete</a>';
                $data[] = $sub_row;
            }
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function getItemsShow() {
        $items = DB::select(DB::raw('SELECT * FROM `items` where id not in (select child_id from item_relation) AND items.organization_id="' . Auth::user()->organization_id . '" AND items.deleted_at IS NULL'));
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
            $sql = "select items.* from items join item_relation on items.id=item_relation.child_id where items.organization_id='" . Auth::user()->organization_id . "' AND items.deleted_at IS NULL AND item_relation.parent_id='" . $item->id . "'";
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
        $records = Customer::organization()->get();
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

    public function postInitialValues($id, Request $request) {
		if($this->skippedAt() < 5) {
			$org_id = Auth::user()->organization_id;
			$org = Organization::find($org_id);
			$org->profile_skipped_at_step = 5;
			$org->save();
		}
		
        $user = $request->user();
        $init_val = InitialValue::find($id);
        $init_val->invoice_number = $request->invoice_number;
        $init_val->standard_tare_weight = $request->standard_tare_weight;
        $init_val->cart_number = $request->cart_number;
		$init_val->manifest_number = $request->manifest_number;
        $init_val->save();

        $user = User::find($user->id);
        $user->visited = 1;
        $user->save();

        return redirect('admin');
    }

    public function getView(Request $request) {
        $user = $request->user();
        $user_id = $user->id;
        $user_profile = UserProfile::where('user_id', '=', $user_id)->first();
        $countries = Country::all();
		$visited = intval($user->visited);
        return view('admin.profile.view', [ 'user' => $user_profile, 'countries' => $countries, 'showDashBoard' => true, 'visited' => $visited]);
    }

    public function getResetPassword() {
        return view('admin.profile.resetPassword', [ 'isCurrent' => true]);
    }

    public function postResetPassword(ResetPassword $request) {
        $user = $request->user();
        $u = User::find($user->id);
        $u->password = bcrypt($request->password);

        if (Hash::check($request->current_password, $user->password)) {
            $u->save();
            return redirect('admin/profile/reset-password')->with('status', 'Your password has been updated successfully.');
        } else {
            return redirect('admin/profile/reset-password')->with('status', 'Your have entered invalid current password.');
        }
    }

}
