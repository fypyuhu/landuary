<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\OutgoingCart;
use App\Models\ShipManifest;
use App\Models\CustomerOutgoingCartItem;
use Auth;
use App\Models\UserProfile;
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $customers=Customer::organization()->get();
		$rec_id = '';
		$current_customer = '';
		if (session('status')) {
			$last_rec = ShipManifest::orderBy('id', 'desc')->first();
			$rec_id = count($last_rec) > 0 ? $last_rec->id : 0;
			$current_customer = count($last_rec) > 0 ? $last_rec->customer_id : 0;
		}
        return view('admin.shiping.index',["customers"=>$customers, 'rec_id' => $rec_id, 'current_customer' => $current_customer]);
    }

    public function getDetails($id,$department_id=-1){
        $active_customer=Customer::find($id);
        $customers=Customer::organization()->get();
        $departments=CustomerDepartment::where('customer_id','=',$id)->get();
        if($department_id==-1){
            $carts=OutgoingCart::organization()->where('customer_id','=',$id)->where('status','=','Ready')->get();
        }
        else{
            $carts=OutgoingCart::organization()->where('customer_id','=',$id)->where('status','=','Ready')->where('department_id','=',$department_id)->get();    
        }
        return view('admin.shiping.details',["carts"=>$carts,"customers"=>$customers,"active_customer"=>$active_customer,"departments"=>$departments,"department_id"=>$department_id]);
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
             foreach($request->carts as $id){
                 $out_going_cart=OutgoingCart::find($id);
                 $out_going_cart->status="Out";
                 $out_going_cart->save();
             }
        }
        $manifest->save();
        //return redirect('/admin/shiping-manifest/recipt/'.$manifest->id);
		return redirect('/admin/shiping-manifest')->with('status', 'Shipping manifest has been created successfully.');
    }
	
	public function getShowReceipt($id) {
   		//DD($request);
   		return redirect('/admin/shiping-manifest/recipt/'.$id)->with('status', 'view');
   }

    public function getRecipt($id){
        $manifest=ShipManifest::find($id);
        $customer=Customer::find($manifest->customer_id);
        $items=CustomerOutgoingCartItem::getCartItemsById($id);
		
		$carts = array();
		$gross_weight = array();
		$net_weight = array();
		
		foreach($items as $key => $item) {
			if(!in_array($item->cart_id, $carts)) {
				$carts[] = $item->cart_id;
				$gross_weight[] = $item->gross_weight;
				$net_weight[] = $item->net_weight;
			}
		}
		
        $user=UserProfile::where('user_id','=',Auth::user()->id)->first();
        return view('admin.shiping.recipt',['user'=>$user,'items'=>$items,'customer'=>$customer,'manifest'=>$manifest, 'total_gross_weight' => array_sum($gross_weight), 'total_net_weight' => array_sum($net_weight)]);
    }
    public function getEdit($id){
        $manifest=ShipManifest::find($id);
        if($manifest->shipping_date!=date("Y-m-d",time())){
            return back();
        }
        $customer=Customer::find($manifest->customer_id);
        $department=CustomerDepartment::find($manifest->department_id);
        if($manifest->department_id==-1){
            $carts=OutgoingCart::organization()->where('customer_id','=',$manifest->customer_id)->where('status','=','Ready')->get();
        }
        else{
            $carts=OutgoingCart::organization()->where('customer_id','=',$id)->where('status','=','Ready')->where('department_id','=',$manifest->department_id)->get();    
        }
        $selected_carts=OutgoingCart::find(explode(",",$manifest->outgoing_cart_id));
        return view('admin.shiping.edit',['customer'=>$customer,'manifest'=>$manifest,
                    'department'=>$department,
                    'carts'=>$carts,
                    'selected_carts'=>$selected_carts
            ]);
    }
    public function postEdit($id, Request $request){
        $manifest=ShipManifest::find($id);
        $ogc=explode(",",$manifest->outgoing_cart_id);
        $carts=implode(",",$request->carts);
        $manifest->outgoing_cart_id=$carts;
        foreach($ogc as $id){
                 $out_going_cart=OutgoingCart::find($id);
                 $out_going_cart->status="Ready";
                 $out_going_cart->save();
             }
        foreach($request->carts as $id){
                 $out_going_cart=OutgoingCart::find($id);
                 $out_going_cart->status="Out";
                 $out_going_cart->save();
             }
        $manifest->save();
        return redirect('/admin/shiping-manifest/recipt/'.$manifest->id);
    }
}
