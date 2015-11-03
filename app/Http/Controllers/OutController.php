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
		$items = Item::where('status', '>=', '0')->get();
		$customers = DB::table('customers')->get();
		$depts = DB::table('customers_departments')->get();
        return view('admin.out.index', ['carts' => $carts, 'items' => $items, 'customers' => $customers, 'depts' => $depts]);
    }
	
	public function getCustomerInfo(Request $request) {
		$carts = Cart::all();
		$items = Item::where('status', '>=', '0')->get();
		$customers = DB::table('customers')->get();
		$depts = DB::table('customers_departments')->where('customer_id', '=', $request->customer_id)->get();
		$current_customer = DB::table('customers')->where('id', '=', $request->customer_id)->get();
		
		return view('admin.out.customer', ['depts' => $depts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer[0]]);
	}
	
	public function postItem(Request $request) {
		$coci = new CustomerOutgoingCartItem;
		$coci->name = $request->item_name;
        $item->item_number = $request->item_number;
        $item->description = $request->item_desc;
        $item->weight = $request->item_weight;
        $item->transaction_type = $request->transaction_type;
        $item->save();
		
		$items = Item::where('status', '>=', '0')->get();
		return view('admin.out.item', ['items' => $items]);
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
