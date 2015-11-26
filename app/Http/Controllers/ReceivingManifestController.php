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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
		$rm->department_from = $request->department_from;
		$rm->department_to = $request->department_to;
		$rm->date_from = date('Y-m-d', strtotime($request->date_from));
		$rm->date_to = date('Y-m-d', strtotime($request->date_to));
		$rm->save();
		return redirect('/admin/receiving-manifest/receipt/'.$rm->id);
	}
	
	public function getReceipt($id, Request $request) {
		$manifest = ReceivingManifest::find($id);
		$customer = Customer::find($manifest->customer_id)->first();
		if($request->has('department_from') || $request->has('department_to')) {
			if($manifest->department_from != '' && $manifest->department_to != '') {
				$departments = CustomerDepartment::whereBetween('id', [$manifest->department_from, $manifest->department_to])->get();
				$department_from = $departments[0]->department_name;
				$department_to = $departments[count($departments)-1]->department_name;
			}
			else if($manifest->department_from != '' || $manifest->department_to != '') {
				$departments = CustomerDepartment::where('id', '=', $manifest->department_from)->orWhere('id', '=', $manifest->department_to)->get();
				if($manifest->department_from != '') {
					$department_from = $departments[0]->department_name;
					$department_to = '';
				} else {
					$department_to = $departments[0]->department_name;
					$department_from = '';
				}
			} else {
				$departments = '';
				$department_from = '';
				$department_to = '';
			}
			
			$department_range = array($department_from, $department_to);
		}	
		
		$user=UserProfile::where('user_id','=',Auth::user()->id)->first();
		$items = ReceivingManifest::getCustomerIncomingCartItems($manifest->customer_id, $manifest->date_from, $manifest->date_to);
		return view('admin.receiving-manifest.receipt', [ 'user'=>$user,'manifest' => $manifest, 
														  'customer' => $customer, 
														  if($request->has('department_from') || $request->has('department_to')) {
														  'departments' => $departments, 
														  'department_range' => $department_range, 
														  }
														  'items' => $items 
														  ]);
	}
	
	public function getAjaxForm(Request $request) {
		$id = $request->customer_id;
		$customers = Customer::all();
		$departments = CustomerDepartment::where('customer_id', '=', $id)->get();
		$current = Customer::where('id', '=', $id)->first();
		return view('admin.receiving-manifest.ajaxForm', [ 'customers' => $customers, 'departments' => $departments, 'current' => $current ]);
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
     *     * @param  int  $id
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
