<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\OutgoingCart;
use App\Models\ShipManifest;
use App\Models\CustomerOutgoingCartItem;
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $customers=Customer::all();
        return view('admin.shiping.index',["customers"=>$customers]);
    }

    public function getDetails($id){
        $active_customer=Customer::find($id);
        $customers=Customer::all();
        $departments=CustomerDepartment::find($id);
        $carts=OutgoingCart::where('customer_id','=',$id)->get();
        return view('admin.shiping.details',["carts"=>$carts,"customers"=>$customers,"active_customer"=>$active_customer,"departments"=>$departments]);
    }
    public function postCreate(Request $request)
    {
        $manifest=new ShipManifest;
        $manifest->customer_id=$request->customer;
        $manifest->department_id=$request->department;
        $manifest->shipping_date=date('Y-m-d',strtotime($request->ship_date));
        $manifest->description=$request->discription;
        if($request->has('carts')){
            $carts=implode(",",$request->carts);
             $manifest->outgoing_cart_id=$carts;
        }
        $manifest->save();
        return redirect('/admin/shiping-manifest/recipt/'.$manifest->id);
    }

    public function getRecipt($id){
        $manifest=ShipManifest::find($id);
        $customer=Customer::find($manifest->customer_id);
        $items=CustomerOutgoingCartItem::getCartItemsById($id);
        return view('admin.shiping.recipt',['items'=>$items,'customer'=>$customer,'manifest'=>$manifest]);
    }
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
