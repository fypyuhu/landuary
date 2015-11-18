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
use DB;

class InController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $carts = Cart::all();
		$customers = Customer::all();
		$depts = CustomerDepartment::all();
        return view('admin.in.index', ['carts' => $carts, 'customers' => $customers, 'depts' => $depts]);
    }
	
	public function getCarts()
    {
        return view('admin.in.carts');
    }
	
	public function getAjaxForm(Request $request) {
		$carts = Cart::all();
		$items = DB::table('items')
					->join('customers_items', 'items.id', '=', 'customers_items.item_id')
					->select('items.*')
					->where('items.status', '>', 0)
					->where('customers_items.customer_id', '=', $request->customer_id)
					->get();
		$customers = Customer::all();
		$depts = CustomerDepartment::where('customer_id', '=', $request->customer_id)->get();
		$current_customer = Customer::where('id', '=', $request->customer_id)->get();
		
		return view('admin.in.form', ['depts' => $depts, 'carts' => $carts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer[0]]);
	}
	
	public function getAddItem(Request $request) {
	    $item = Item::where('id', '=', $request->item_id)->get();
		$quantity = $request->quantity;
		return view('admin.in.addItem', ['item' => $item[0], 'quantity' => $quantity]);
	}
	
	public function getCartInfo(Request $request) {
		$carts = Cart::all();
	    $cart = Cart::where('id', '=', $request->cart_id)->get();
		return view('admin.in.getCart', ['current_cart' => $cart[0], 'carts' => $carts]);
	}
	
	public function getWeights(Request $request) {
		$item = Item::where('id', '=', $request->item_id)->get();
		$gross_weight = $request->gross_weight + ($item[0]->weight * $request->num_items);
		$net_weight = $request->net_weight + ($item[0]->weight * $request->num_items);
		return view('admin.in.weight', ['gross_weight' => $gross_weight, 'net_weight' => $net_weight]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        $ogc = new IncomingCart;
		$ogc->customer_id = $request->customer;
		$ogc->department_id = $request->department;
		$ogc->cart_id = $request->has('cart_number_textfield') ? $request->cart_number_textfield : $request->cart_number_dropdown;
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
		
		foreach($request->item_cart as $key=>$value) {
			$ogc_item = new CustomerIncomingCartItem;
			$ogc_item->incoming_cart_id = $ogc->id;
			$ogc_item->item_id = $value;
			$ogc_item->quantity = $request->item_quantity[$key];
			$ogc_item->save();
		}
		
		return back();
    }
	
	public function getInCartsList() {
		$incoming_carts = IncomingCart::inCartsList();
		return view('admin.cartsList.index', [ 'carts' => $incoming_carts ]);
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
	 
	public function getEdit($id) {
		return view('admin.in.edit');
	}
	
    public function postEdit($id)
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
