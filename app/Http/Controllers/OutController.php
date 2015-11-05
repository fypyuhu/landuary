<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Out;
use App\Models\Cart;
use App\Models\Item;
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
		$customers = DB::table('customers')->get();
		$depts = DB::table('customers_departments')->get();
        return view('admin.out.index', ['carts' => $carts, 'customers' => $customers, 'depts' => $depts]);
    }
	
	public function getAjaxForm(Request $request) {
		$carts = Cart::all();
		$items = DB::table('items')
					->join('customers_items', 'items.id', '=', 'customers_items.item_id')
					->select('items.*')
					->where('items.status', '>', 0)
					->where('customers_items.customer_id', '=', $request->customer_id)
					->get();
		$customers = DB::table('customers')->get();
		$depts = DB::table('customers_departments')->where('customer_id', '=', $request->customer_id)->get();
		$current_customer = DB::table('customers')->where('id', '=', $request->customer_id)->get();
		
		return view('admin.out.form', ['depts' => $depts, 'carts' => $carts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer[0]]);
	}
	
	public function getAddItem(Request $request) {
	    $item = DB::table('items')->where('id', '=', $request->item_id)->get();
		$quantity = $request->quantity;
		return view('admin.out.addItem', ['item' => $item[0], 'quantity' => $quantity]);
	}
	
	public function getCartInfo(Request $request) {
		$carts = Cart::all();
	    $cart = DB::table('carts')->where('id', '=', $request->cart_id)->get();
		return view('admin.out.getCart', ['current_cart' => $cart[0], 'carts' => $carts]);
	}
	
	public function getWeights(Request $request) {
		$item = DB::table('items')->where('id', '=', $request->item_id)->get();
		$gross_weight = $request->gross_weight + $item[0]->weight;
		$net_weight = $request->net_weight + $item[0]->weight;
		return view('admin.out.weight', ['gross_weight' => $gross_weight, 'net_weight' => $net_weight]);
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
