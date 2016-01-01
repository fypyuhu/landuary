<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OutgoingCart;
use App\Models\Cart;
use App\Models\Item;
use App\Models\CustomerOutgoingCartItem;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\InitialValue;
use App\Models\Organization;
use DB;
use Auth;

class OutController extends Controller {

    public function getIndex() {
        $carts = Cart::organization()->get();
        $customers = Customer::organization()->get();
        $depts = CustomerDepartment::organization()->get();
		$cart_id = '';
		$current_customer = '';
		if (session('status')) {
			$ogc = OutgoingCart::orderBy('id', 'desc')->first();
			$cart_id = $ogc->id;
			$current_customer = $ogc->customer_id;
		}
        return view('admin.out.index', ['carts' => $carts, 'customers' => $customers, 'depts' => $depts, 'cart_id' => $cart_id, 'current_customer' => $current_customer]);
    }

    public function getCarts() {
        return view('admin.out.carts');
    }

    public function getAjaxForm(Request $request) {
        $carts = Cart::organization()->where('customer_number', '=', $request->customer_id)->get();
        $items = DB::table('items')
                ->join('customers_items', 'items.id', '=', 'customers_items.item_id')
                ->select('items.*')
                ->where('items.transaction_type', '!=', 'In')
                ->where('customers_items.customer_id', '=', $request->customer_id)
                ->where('items.organization_id', '=', Auth::user()->organization_id)
                ->get();
        $customers = Customer::organization()->get();
        $depts = CustomerDepartment::organization()->where('customer_id', '=', $request->customer_id)->get();
        $current_customer = Customer::organization()->where('id', '=', $request->customer_id)->get();
        return view('admin.out.form', ['depts' => $depts, 'carts' => $carts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer[0]]);
    }

    public function getAddItem(Request $request) {
        $item = Item::organization()->where('id', '=', $request->item_id)->get();
        $quantity = $request->quantity;
        return view('admin.out.addItem', ['item' => $item[0], 'quantity' => $quantity]);
    }

    public function getCartInfo(Request $request) {
        $carts = Cart::organization()->get();
        $cart = Cart::organization()->where('id', '=', $request->cart_id)->get();
        return view('admin.out.getCart', ['current_cart' => $cart[0], 'carts' => $carts]);
    }

    public function getWeights(Request $request) {
        $item = Item::organization()->where('id', '=', $request->item_id)->get();
        $gross_weight = $request->gross_weight + ($item[0]->weight * $request->num_items);
        return $gross_weight;
        // = $request->net_weight + ($item[0]->weight * $request->num_items);
        //return view('admin.out.weight', ['gross_weight' => $gross_weight, 'net_weight' => $net_weight]);
    }

    public function postCreate(Request $request) {
        $ogc = new OutgoingCart;
        $ogc->customer_id = $request->customer;
        $ogc->department_id = $request->department;
        $ogc->cart_id = $request->has('cart_number_textfield') ? $request->cart_number_textfield : $request->cart_number_dropdown;
        $ogc->shipping_date = date('Y-m-d', strtotime($request->ship_date));
        $ogc->gross_weight = $request->gross_weight;
        $ogc->net_weight = $request->net_weight;
        $ogc->status = 'Ready';
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
        $ogc->save();
        foreach ($request->item_cart as $key => $value) {
            $ogc_item = new CustomerOutgoingCartItem;
            $ogc_item->outgoing_cart_id = $ogc->id;
            $ogc_item->item_id = $value;
            $ogc_item->quantity = $request->item_quantity[$key];
            $ogc_item->save();
        }
        //return redirect('/admin/out/receipt/' . $ogc->id);
		return redirect('/admin/out')->with('status', 'Outgoing cart has been created successfully.');
    }

    public function getReceipt($id) {
        $cart = OutgoingCart::find($id);
        $department = CustomerDepartment::find($cart->department_id);
        $customer = Customer::find($cart->customer_id);
        $items = CustomerOutgoingCartItem::getItems($id);
        $user = Auth::user();
        $shipping_date = date('Y-m-d', strtotime($cart->shipping_date));
        $organization = Organization::find($user->organization_id);
        return view('admin.out.receipt', ['cart' => $cart,
            'department' => $department,
            'customer' => $customer,
            'items' => $items,
            'organization' => $organization,
            'shipping_date' => $shipping_date]);
    }

    public function getEdit($id) {
        $ogc = OutgoingCart::find($id);
        $customer = Customer::find($ogc->customer_id);
        $selected_items = CustomerOutgoingCartItem::getItems($id);
        $department = CustomerDepartment::find($ogc->department_id);
        $cart = Cart::find($ogc->cart_id);
        $items = DB::table('items')
                ->join('customers_items', 'items.id', '=', 'customers_items.item_id')
                ->select('items.*')
                ->where('items.transaction_type', '!=', 'In')
                ->where('customers_items.customer_id', '=', $ogc->customer_id)
                ->where('items.organization_id', '=', Auth::user()->organization_id)
                ->get();
        return view('admin.out.edit', ['ogc' => $ogc, 'selected_items' => $selected_items,
            'customer' => $customer,
            'department' => $department,
            'cart' => $cart,
            'items' => $items
        ]);
    }

    public function postEdit($id, Request $request) {
        $ogc = OutgoingCart::find($id);
        $ogc->gross_weight = $request->gross_weight;
        $ogc->net_weight = $request->net_weight;
        $ogc->save();
        $ogc_items = CustomerOutgoingCartItem::where('outgoing_cart_id', '=', $id)->delete();
        foreach ($request->item_cart as $key => $value) {
            $ogc_item = new CustomerOutgoingCartItem;
            $ogc_item->outgoing_cart_id = $ogc->id;
            $ogc_item->item_id = $value;
            $ogc_item->quantity = $request->item_quantity[$key];
            $ogc_item->save();
        }
        return redirect($request->return_url);
    }
	
	public function getDelete($id) {
        return view('admin.out.delete', ['id' => $id]);
    }

    public function postDelete($id, Request $request) {
        $rec = OutgoingCart::find($id);
        $rec->delete();
		return redirect('/admin/shiping-manifest')->with('status', 'Selected cart has been deleted successfully.');
    }

}
