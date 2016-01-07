<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReceivingManifest;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\CustomerIncomingCartItem;
use App\Models\IncomingCart;
use App\Models\Item;
use Auth;
use App\Models\UserProfile;
class ReceivingManifestController extends Controller
{
    public function getIndex()
    {
		$customers = ReceivingManifest::getCustomerByIncomingCart();
		
		$rec_id = '';
		$current_customer = '';
		if (session('status')) {
			$last_rec = ReceivingManifest::orderBy('id', 'desc')->first();
			$rec_id = $last_rec->id;
			$current_customer = $last_rec->customer_id;
		}
        return view('admin.receiving-manifest.index', ['customers' => $customers, 'rec_id' => $rec_id, 'current_customer' => $current_customer]);
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function postCreate(Request $request) {
		$ic = IncomingCart::where('invoiced', '=', 0)->where(function ($query) use ($request) {
																if($request->customer != "-1") {
																	$query->where('customer_id', '=', $request->customer);
																}
																if($request->department != "-1") {
																	$query->where('department_id', '=', $request->department);
																}
														})->whereBetween('receiving_date', [date('Y-m-d', strtotime($request->date_from)), date('Y-m-d', strtotime($request->date_to))])->get();
			  
			  
		
		$ic_ids = array();
		foreach($ic as $ic_id) {
			$ic_ids[] = $ic_id->id;
		}	
			
		if(count($ic_ids) > 0) {	
			$rm = new ReceivingManifest;
			$rm->customer_id = $request->customer;
			$rm->department_id = $request->department;
			$rm->incoming_cart_ids = implode(',',$ic_ids);
			$rm->date_from = date('Y-m-d', strtotime($request->date_from));
			$rm->date_to = date('Y-m-d', strtotime($request->date_to));
			$rm->save();
			
			//return redirect('/admin/receiving-manifest/receipt/'.$rm->id);
			return redirect('/admin/receiving-manifest')->with('status', 'Receiving manifest has been created successfully.');
		} else {
			return back()->with('status', 'No Carts/Items found within the selected date.');
		}
	}
	
	public function getReceipt($id, Request $request) {
		$manifest = ReceivingManifest::find($id);
		$customer = Customer::find($manifest->customer_id);
		$organization = UserProfile::where('user_id', '=', Auth::user()->id)->first();
		
		/*$departments = '';
		$department_from = '';
		$department_to = '';
		
		if($manifest->department_from != '' && $manifest->department_to != '') {
			$departments = CustomerDepartment::organization()->whereBetween('id', [$manifest->department_from, $manifest->department_to])->get();
			if(count($departments) > 0) {
				$department_from = $departments[0]->department_name;
				$department_to = $departments[count($departments)-1]->department_name;
			}
		}
		else if($manifest->department_from != '' || $manifest->department_to != '') {
			$departments = CustomerDepartment::organization()->where('id', '=', $manifest->department_from)->orWhere('id', '=', $manifest->department_to)->get();
			if($manifest->department_from != '') {
				if(count($departments) > 0) {
					$department_from = $departments[0]->department_name;
					$department_to = '';
				}
			} else {
				if(count($departments) > 0) {
					$department_to = $departments[0]->department_name;
					$department_from = '';
				}
			}
		} else {
			$departments = '';
			$department_from = '';
			$department_to = '';
		}*/
		$user=UserProfile::where('user_id','=',Auth::user()->id)->first();
		$items = ReceivingManifest::getCustomerIncomingCartItems($manifest->customer_id, $manifest->date_from, $manifest->date_to, $manifest->department_id);
		
		$carts = array();
		$gross_weight = array();
		$net_weight = array();
		
		foreach($items as $key => $item) {
			if(!in_array($item->incoming_cart_id, $carts)) {
				$carts[] = $item->incoming_cart_id;
				$gross_weight[] = $item->gross_weight;
				$net_weight[] = $item->net_weight;
			}
		}
		
		foreach($carts as $cart) {
			$cart = IncomingCart::find($cart);
			$cart->invoiced = 1;
			$cart->save();
		}
		
		$department = '';
		if($items)
			$department = $items[0]->department_name;
			
		return view('admin.receiving-manifest.receipt', [ 'user'=>$user, 'manifest' => $manifest, 'customer' => $customer, 'department' => $department, 'items' => $items, 'total_gross_weight' => array_sum($gross_weight), 'total_net_weight' => array_sum($net_weight), 'organization' => $organization ]);
	}
	
	public function getShowReceipt($id) {
   		//DD($request);
   		return redirect('/admin/receiving-manifest/view-receipt/'.$id)->with('status', 'view');
   }
	
	public function getViewReceipt($id) {
		$manifest = ReceivingManifest::find($id);
		$customer = Customer::find($manifest->customer_id);
		$organization = UserProfile::where('user_id', '=', Auth::user()->id)->first();
		
		/*$departments = '';
		$department_from = '';
		$department_to = '';
		
		if($manifest->department_from != '' && $manifest->department_to != '') {
			$departments = CustomerDepartment::organization()->whereBetween('id', [$manifest->department_from, $manifest->department_to])->get();
			if(count($departments) > 0) {
				$department_from = $departments[0]->department_name;
				$department_to = $departments[count($departments)-1]->department_name;
			}
		}
		else if($manifest->department_from != '' || $manifest->department_to != '') {
			$departments = CustomerDepartment::organization()->where('id', '=', $manifest->department_from)->orWhere('id', '=', $manifest->department_to)->get();
			if($manifest->department_from != '') {
				if(count($departments) > 0) {
					$department_from = $departments[0]->department_name;
					$department_to = '';
				}
			} else {
				if(count($departments) > 0) {
					$department_to = $departments[0]->department_name;
					$department_from = '';
				}
			}
		} else {
			$departments = '';
			$department_from = '';
			$department_to = '';
		}*/
		$user=UserProfile::where('user_id','=',Auth::user()->id)->first();
		$items = ReceivingManifest::getCustomerIncomingCartItems($manifest->customer_id, $manifest->date_from, $manifest->date_to, $manifest->department_id, true);
		
		$carts = array();
		$gross_weight = array();
		$net_weight = array();
		
		foreach($items as $key => $item) {
			if(!in_array($item->incoming_cart_id, $carts)) {
				$carts[] = $item->incoming_cart_id;
				$gross_weight[] = $item->gross_weight;
				$net_weight[] = $item->net_weight;
			}
		}
		
		foreach($carts as $cart) {
			$cart = IncomingCart::find($cart);
			$cart->invoiced = 1;
			$cart->save();
		}
		
		if($items)
			$department = $items[0]->department_name;
			
		return view('admin.receiving-manifest.receipt', [ 'user'=>$user, 'manifest' => $manifest, 'customer' => $customer, 'department' => $department, 'items' => $items, 'total_gross_weight' => array_sum($gross_weight), 'total_net_weight' => array_sum($net_weight), 'organization' => $organization ]);
	}
	
	public function getAjaxForm(Request $request) {
		$id = $request->customer_id;
		$customers = Customer::organization()->get();
		$departments = CustomerDepartment::organization()->where('customer_id', '=', $id)->get();
		$current = Customer::organization()->where('id', '=', $id)->first();
		return view('admin.receiving-manifest.ajaxForm', [ 'customers' => $customers, 'departments' => $departments, 'current' => $current ]);
	}
	
}
