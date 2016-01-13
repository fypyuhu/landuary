<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Rewash;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\Item;
use App\Models\RewashItem;
use DB;

class RewashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$customers = Customer::organization()->get();
		
		$rec_id = '';
		$current_customer = '';
		if (session('status')) {
			$last_rec = Rewash::orderBy('id', 'desc')->first();
			$rec_id = $last_rec->id;
			$current_customer = $last_rec->customer_id;
		}
        return view('admin.rewash.index', ['customers' => $customers, 'rec_id' => $rec_id, 'current_customer' => $current_customer]);
    }
	
	public function getAjaxForm(Request $request) {
		$items = DB::table('items')
					->join('customers_items', 'items.id', '=', 'customers_items.item_id')
					->select('items.*')
                    ->where('items.transaction_type', '!=', 'Out')
					->where('customers_items.customer_id', '=', $request->customer_id)
					->get();
		$customers = Customer::all();
		$depts = CustomerDepartment::where('customer_id', '=', $request->customer_id)->get();
		$current_customer = Customer::where('id', '=', $request->customer_id)->first();
		
		return view('admin.rewash.form', ['depts' => $depts, 'items' => $items, 'customers' => $customers, 'current_customer' => $current_customer]);
	}
	
	public function getAddItem(Request $request) {
	    $item = Item::where('id', '=', $request->item_id)->first();
		$quantity = $request->quantity;
		return view('admin.rewash.addItem', ['item' => $item, 'quantity' => $quantity]);
	}
	
	public function postCreate(Request $request) {
		$rewash = new Rewash;
		$rewash->customer_id = $request->customer;
		$rewash->department_id = $request->department;
		$rewash->total_items = array_sum($request->item_quantity);
		$rewash->total_weight = $request->total_weight;
		$rewash->rewash_date = date('Y-m-d', strtotime($request->rewash_date));
		$rewash->save();
		
		foreach ($request->item_cart as $key => $value) {
            $rewash_item = new RewashItem;
            $rewash_item->rewash_id = $rewash->id;
            $rewash_item->item_id = $value;
            $rewash_item->quantity = $request->item_quantity[$key];
            $rewash_item->save();
        }
		
		//return redirect('/admin/rewash/list');
		return redirect('/admin/rewash')->with('status', 'Rewash cart has been created successfully.');
	}
	
	public function getListShow(Request $request) {
        $rewash_list = Rewash::rewashList($request);
		$sql = DB::select(DB::raw("SELECT FOUND_ROWS() AS `found_rows`;"));
		$total_rows = $sql[0]->found_rows;
        $dataa = array();
		foreach ($rewash_list as $rec) {
			$row = array();
			$row["rewash_date"] = date('d F, Y', strtotime($rec->rewash_date));
			$row["customer_name"] = $rec->name;
			$row["customer_number"] = $rec->customer_number;
			$row["department_name"] = $rec->department_name;
			$row["number_of_items"] = $rec->number_of_items;
			$row["total_weight"] = $rec->total_weight;
			$row["actions"] = '<a href="/admin/rewash/delete/' . $rec->id . '" data-mode="ajax">Delete</a>';
			$dataa[] = $row;
		}
		
		$data[] = array(
			'TotalRows' => $total_rows,
			'Rows' => $dataa
		);
		echo json_encode($data);
	}
	
	public function getList(Request $request) {
		$customers = Customer::organization()->get();
		return view('admin.rewash.list', ['customers' => $customers]);
	}
	
	public function getJson(Request $request) {
		$rewash_list = Rewash::rewashList($request);
		$json = '{
		  "cols": [
				{"id":"","label":"Rewash Date","pattern":"","type":"string"},
				{"id":"","label":"Weight","pattern":"","type":"number"}
			  ],
		  "rows": [';
		  		foreach($rewash_list as $key => $value) {
					$json .= '{"c":[{"v":"'.date('d-m-Y',strtotime($value->rewash_date)).'","f":null},{"v":'.$value->total_weight.',"f":null}]}';
					if(count($rewash_list) > 1 && $key < count($rewash_list)-1)
						$json .= ',';
				}
			  $json .= ']}';
		
		/*$rewash_list = Rewash::rewashList($request);
		DD($rewash_list[0]->name);
		$customer_name = $request->name != -1 && count($rewash_list) > 0 ? $rewash_list[0]->name : 'All Customers';	*/		
		return view('admin.rewash.json', ['json' => $json/*, 'customer_name' => $customer_name*/]);
	}
	
	public function getDelete($id) {
        return view('admin.rewash.delete', ['id' => $id]);
    }
	
	public function postDelete($id) {
        $rewash = Rewash::find($id);
        $rewash->delete();
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
