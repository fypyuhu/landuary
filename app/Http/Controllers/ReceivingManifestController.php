<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerDepartment;

class ReceivingManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$customers = Customer::all();
        return view('admin.receiving-manifest.index', ['customers' => $customers]);
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function postCreate(Request $request) {
		$rm = new ReceivingManifest;
		return view('admin.receiving-manifest.receipt');
		//return redirect()->route('admin/receiving-manifest/receipt');
	}
	
	public function getReceipt() {
		return view('admin.receiving-manifest.receipt');
	}
	
	public function getAjaxForm(Request $request) {
		$id = $request->customer_id;
		$customers = Customer::all();
		$departments = CustomerDepartment::where('customer_id', '=', $id)->get();
		$current = Customer::where('id', '=', $id)->get();
		return view('admin.receiving-manifest.ajaxForm', [ 'customers' => $customers, 'departments' => $departments, 'current' => $current[0] ]);
	}
	
	public function store(Request $request)
    {
        //	
	}
	
    /**
     * Show the form for creating a new resource.		return view('admin.receiving-man     * @return \Illuminate\Http\Response
ted resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
