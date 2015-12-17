<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\IncomingCart;
use App\Models\Cart;
use App\Models\Item;
use App\Models\CustomerIncomingCartItem;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\InitialValue;
use App\Models\Organization;
use App\Models\UserProfile;
use DB;
use Auth;

class InController extends Controller {

   public function getIndex() {
        $carts = Cart::organization()->get();
        $customers = Customer::organization()->get();
        $depts = CustomerDepartment::organization()->get();
        return view('admin.in.index', ['carts' => $carts, 'customers' => $customers, 'depts' => $depts]);
    }

    public function getCarts() {
        return view('admin.in.carts');
    }

    public function getAjaxForm(Request $request) {
        $carts = Cart::where('customer_number', '=', $request->customer_id)->get();
        $items = DB::table('items')
                ->join('customers_items', 'items.id', '=', 'customers_items.item_id')
                ->select('items.*')
                ->where('items.transaction_type', '!=', 'Out')
                ->where('customers_items.customer_id', '=', $request->customer_id)
                ->where('items.organization_id', '=', Auth::user()->organization_id)
                ->get();
        $customers = Customer::organization()->get();
        $depts = CustomerDepartment::organization()->where('customer_id', '=', $request->customer_id)->get();
        $current_customer = Customer::organization()->where('id', '=', $request->customer_id)->get();

        return view('admin.in.form', ['depts' => $depts, 'carts' => $carts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer[0]]);
    }

    public function getAddItem(Request $request) {
        $item = Item::organization()->where('id', '=', $request->item_id)->get();
        $quantity = $request->quantity;
        return view('admin.in.addItem', ['item' => $item[0], 'quantity' => $quantity]);
    }

    public function getCartInfo(Request $request) {
        $carts = Cart::organization()->get();
        $cart = Cart::organization()->where('id', '=', $request->cart_id)->get();
        return view('admin.in.getCart', ['current_cart' => $cart[0], 'carts' => $carts]);
    }

    public function getWeights(Request $request) {
        $item = Item::organization()->where('id', '=', $request->item_id)->get();
        return ($item[0]->weight * $request->num_items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request) {
        $ogc = new IncomingCart;
        $ogc->customer_id = $request->customer;
        $ogc->department_id = $request->department;
        if ($request->has('is_exchange_cart')) {
            $ogc->cart_id = $request->cart_number_dropdown;
            $ogc->is_exchange_cart = 1;
        } else {
            $user = Auth::user();
            $initial_values = InitialValue::where('organization_id', '=', $user->organization_id)->first();
            $ogc->cart_id = $initial_values->cart_number;
            $ogc->is_exchange_cart = 0;
            $initial_values->cart_number = $initial_values->cart_number + 1;
            $initial_values->save();
        }
        $ogc->receiving_date = date('Y-m-d', strtotime($request->receiving_date));
        $ogc->gross_weight = $request->gross_weight;
        $ogc->net_weight = $request->net_weight;
        $ogc->status = 'In';
        if ($request->has('is_exchange_cart')) {
            $ogc->is_exchange_cart = $request->is_exchange_cart;
            $ogc->cart_id = $request->cart_number_dropdown;
        } else {
            $ogc->cart_id = $request->cart_number_textfield;
        }

        $ogc->save();

        foreach ($request->item_cart as $key => $value) {
            $ogc_item = new CustomerIncomingCartItem;
            $ogc_item->incoming_cart_id = $ogc->id;
            $ogc_item->item_id = $value;
            $ogc_item->quantity = $request->item_quantity[$key];
            $ogc_item->save();
        }

        return redirect('/admin/in/receipt/' . $ogc->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getReceipt($id) {
        $cart = IncomingCart::find($id);
        $department = CustomerDepartment::find($cart->department_id);
        $customer = Customer::find($cart->customer_id);
        $items = CustomerIncomingCartItem::getItems($id);
        $user = Auth::user();
        $organization = Organization::find($user->organization_id);
		$profile = UserProfile::where('user_id', '=', $user->id)->first();
        return view('admin.in.receipt', ['cart' => $cart,
            'department' => $department,
            'customer' => $customer,
            'items' => $items,
            'organization' => $organization,
			'profile' => $profile]);
    }

    public function getEdit($id){
        $ogc = IncomingCart::find($id);
        $customer=Customer::find($ogc->customer_id);
        $selected_items = CustomerIncomingCartItem::getItems($id);
        $department=CustomerDepartment::find($ogc->department_id);
        $cart= Cart::find($ogc->cart_id);
        $items = DB::table('items')
					->join('customers_items', 'items.id', '=', 'customers_items.item_id')
					->select('items.*')
					->where('items.transaction_type', '!=', 'Out')
					->where('customers_items.customer_id', '=', $ogc->customer_id)
                    ->where('items.organization_id', '=',Auth::user()->organization_id)
					->get();
        return view('admin.in.edit',['ogc'=>$ogc,'selected_items'=>$selected_items,
                'customer'=>$customer,
                'department'=>$department,
                'cart'=>$cart,
                'items'=>$items
                ]);
    }
    public function postEdit($id, Request $request){
        $ogc = IncomingCart::find($id);
        $ogc->gross_weight = $request->gross_weight;
        $ogc->net_weight = $request->net_weight;
        $ogc->save();
        $ogc_items=CustomerIncomingCartItem::where('incoming_cart_id','=',$id)->delete();
        foreach($request->item_cart as $key=>$value) {
			$ogc_item = new CustomerIncomingCartItem;
			$ogc_item->incoming_cart_id = $ogc->id;
			$ogc_item->item_id = $value;
			$ogc_item->quantity = $request->item_quantity[$key];
			$ogc_item->save();
		}
        return redirect($request->return_url);        
    }

}
