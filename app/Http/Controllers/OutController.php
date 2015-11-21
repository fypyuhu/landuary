<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OutgoingCart;
use App\Models\Cart;
use App\Models\Item;
use App\Models\CustomerOutgoingCartItem;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use DB;

class OutController extends Controller
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
        return view('admin.out.index', ['carts' => $carts, 'customers' => $customers, 'depts' => $depts]);
    }
	
	public function getCarts()
    {
        return view('admin.out.carts');
    }
	
	public function getAjaxForm(Request $request) {
		$carts = Cart::where('customer_number','=',$request->customer_id)->get();
		$items = DB::table('items')
					->join('customers_items', 'items.id', '=', 'customers_items.item_id')
					->select('items.*')
					->where('items.status', '>', 0)
                                        ->where('items.transaction_type', '=', 'Out')
					->where('customers_items.customer_id', '=', $request->customer_id)
					->get();
		$customers = Customer::all();
		$depts = CustomerDepartment::where('customer_id', '=', $request->customer_id)->get();
		$current_customer = Customer::where('id', '=', $request->customer_id)->get();
		
		return view('admin.out.form', ['depts' => $depts, 'carts' => $carts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer[0]]);
	}
	
	public function getAddItem(Request $request) {
	    $item = Item::where('id', '=', $request->item_id)->get();
		$quantity = $request->quantity;
		return view('admin.out.addItem', ['item' => $item[0], 'quantity' => $quantity]);
	}
	
	public function getCartInfo(Request $request) {
		$carts = Cart::all();
	    $cart = Cart::where('id', '=', $request->cart_id)->get();
		return view('admin.out.getCart', ['current_cart' => $cart[0], 'carts' => $carts]);
	}
	
	public function getWeights(Request $request) {
		$item = Item::where('id', '=', $request->item_id)->get();
		$gross_weight = $request->gross_weight + ($item[0]->weight * $request->num_items);
		$net_weight = $request->net_weight + ($item[0]->weight * $request->num_items);
		return view('admin.out.weight', ['gross_weight' => $gross_weight, 'net_weight' => $net_weight]);
	}
	
    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response 
     */
    public function postCreate(Request $request)
    {
        $ogc = new OutgoingCart;
		$ogc->customer_id = $request->customer;
		$ogc->department_id = $request->department;
		$ogc->cart_id = $request->has('cart_number_textfield') ? $request->cart_number_textfield : $request->cart_number_dropdown;
		$ogc->shipping_date = date('Y-m-d', strtotime($request->ship_date));
		$ogc->gross_weight = $request->gross_weight;
		$ogc->net_weight = $request->net_weight;
		$ogc->status = 'Ready';
		if ($request->has('is_exchange_cart')) {
			$ogc->is_exchange_cart = $request->is_exchange_cart;
			$ogc->cart_id = $request->cart_number_dropdown;
		} else {
			$ogc->cart_id = $request->cart_number_textfield;
		}
		
		$ogc->save();
		
		foreach($request->item_cart as $key=>$value) {
			$ogc_item = new CustomerOutgoingCartItem;
			$ogc_item->outgoing_cart_id = $ogc->id;
			$ogc_item->item_id = $value;
			$ogc_item->quantity = $request->item_quantity[$key];
			$ogc_item->save();
		}
		
		return redirect('/admin/out/receipt/'.$ogc->id);
    }
      public function getReceipt($id){
        $cart=OutgoingCart::find($id);
        $department=CustomerDepartment::find($cart->department_id);
        $customer=Customer::find($cart->customer_id);
        $items=CustomerOutgoingCartItem::getItems($id);
        return view('admin.out.receipt',['cart'=>$cart,
            'department'=>$department,
            'customer'=>$customer,
            'items'=>$items]);
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
		return view('admin.out.edit');
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
