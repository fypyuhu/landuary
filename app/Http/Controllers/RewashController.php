<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Rewash;
use App\Models\Customer;
use App\Models\CustomerDepartment;

class RewashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$customers = Customer::all();
        return view('admin.rewash.index', ['customers' => $customers]);
    }
	
	public function getAjaxForm(Request $request) {
		$items = DB::table('items')
					->join('customers_items', 'items.id', '=', 'customers_items.item_id')
					->select('items.*')
					->where('items.status', '>', 0)
                                        ->where('items.transaction_type', '!=', 'Out')
					->where('customers_items.customer_id', '=', $request->customer_id)
					->get();
		$customers = Customer::all();
		$depts = CustomerDepartment::where('customer_id', '=', $request->customer_id)->get();
		$current_customer = Customer::where('id', '=', $request->customer_id)->get();
		
		return view('admin.in.form', ['depts' => $depts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer[0]]);
	}
	
	public function getAddItem(Request $request) {
	    $item = Item::where('id', '=', $request->item_id)->get();
		$quantity = $request->quantity;
		return view('admin.in.addItem', ['item' => $item[0], 'quantity' => $quantity]);
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
