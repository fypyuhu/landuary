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
        return view('admin.receiving-manifest.index', ['customers' => $customers]);
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function postCreate(Request $request) {
		$rm = new ReceivingManifest;
		$rm->customer_id = $request->customer;
		$rm->department_id = $request->department;
		$rm->date_from = date('Y-m-d', strtotime($request->date_from));
		$rm->date_to = date('Y-m-d', strtotime($request->date_to));
		$rm->save();
		
		$items = ReceivingManifest::getCustomerIncomingCartItems($rm->customer_id, $rm->date_from, $rm->date_to, $rm->department_id);
		$carts = array();
		foreach($items as $item) {
			$carts[] = $item->incoming_cart_id;
		}
		
		$carts = array_unique($carts);
		foreach($carts as $cart) {
			$cart = IncomingCart::find($cart);
			$cart->invoiced = 1;
			$cart->save();
		}
		
		return redirect('/admin/receiving-manifest/receipt/'.$rm->id);
	}
	
	public function getReceipt($id, Request $request) {
		$manifest = ReceivingManifest::find($id);
		$customer = Customer::find($manifest->customer_id)->first();
		
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
		if($items)
			$department = $items[0]->department_name;
			
		if(!$items)
			return back()->with('status', 'No Carts/Items found within the selected date.');
		return view('admin.receiving-manifest.receipt', [ 'user'=>$user, 'manifest' => $manifest, 'customer' => $customer, 'department' => $department, 'items' => $items ]);
	}
	
	public function getAjaxForm(Request $request) {
		$id = $request->customer_id;
		$customers = Customer::organization()->get();
		$departments = CustomerDepartment::organization()->where('customer_id', '=', $id)->get();
		$current = Customer::organization()->where('id', '=', $id)->first();
		return view('admin.receiving-manifest.ajaxForm', [ 'customers' => $customers, 'departments' => $departments, 'current' => $current ]);
	}
	
}
