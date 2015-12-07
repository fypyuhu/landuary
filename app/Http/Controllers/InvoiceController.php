<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\UserProfile;
use App\Models\Invoice;
use App\Models\InitialValue;
use App\Models\Customer;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('admin.invoices.index');
    }
	
	public function getInvoice()
    {
        $user=UserProfile::where('user_id','=',Auth::user()->id)->first();
        return view('admin.invoices.invoice',["user"=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate(){
        $customers=Customer::organization()->get();
        return view('admin.invoices.create',["customers"=>$customers]);
    }
    public function postCreate(Request $request)
    {
        $invoice=new Invoice;
        $initial_values = InitialValue::where('organization_id', '=', $user->organization_id)->first();
        $invoice->invoice_number=$initial_values->invoice_number;
        $invoice->manifest_ids=$request->manifest_list;
        
        $user=UserProfile::where('user_id','=',Auth::user()->id)->first();
        
        return view('admin.invoices.invoice',["user"=>$user]);
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
