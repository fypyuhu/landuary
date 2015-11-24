<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemRelation;
use App\Models\Tax;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\CustomerBilling;
use App\Models\CustomerTax;
use App\Models\CustomerItem;
use DB;

class CustomerController extends Controller {

    public function getIndex() {
        return view('admin.customers.index');
    }

    public function getCreate() {
        $parent_items = DB::select(DB::raw('SELECT items.id,items.name FROM `items` where id not in (select child_id from item_relation) AND items.status=1'));
        $taxes = Tax::all();
        return view('admin.customers.add', ["parent_items" => $parent_items, "taxes" => $taxes]);
    }

    public function postCreate(Request $request) {
        $customer = new Customer;
        $customer->name = $request->ship_to_name;
        $customer->customer_number = $request->customer_number;
        $customer->billing_address = $customer->shipping_address = $request->ship_to_address;
        $customer->billing_city = $customer->shipping_city = $request->ship_to_city;
        $customer->billing_state = $customer->shipping_state = $request->ship_to_state;
        $customer->billing_zipcode = $customer->shipping_zipcode = $request->ship_to_zipcode;
        $customer->billing_phone = $customer->shipping_phone = $request->phone;
        $customer->billing_fax = $customer->shipping_fax = $request->fax;
        if ($request->has('billing_address') && $request->billing_address == '1') {
            $customer->billing_address = $request->billing_ship_to_address;
            $customer->billing_city = $request->billing_ship_to_city;
            $customer->billing_state = $request->billing_ship_to_state;
            $customer->billing_zipcode = $request->billing_ship_to_zipcode;
            $customer->billing_phone = $request->billing_phone;
            $customer->billing_fax = $request->billing_fax;
        }
        $customer->save();
        if ($request->has('use_department')) {
            foreach ($request->department_list as $list) {
                $customer_department = new CustomerDepartment;
                $customer_department->customer_id = $customer->id;
                $customer_department->department_name = $list;
                $customer_department->save();
            }
        }
        $customer_billing = new CustomerBilling;
        $customer_billing->customer_id = $customer->id;
        $customer_billing->bill_type = $request->bill_type;
        $customer_billing->terms = $request->terms;
        $customer_billing->due_date = $request->days_due;
        $customer_billing->save();
        $customer_tax = new CustomerTax;
        $customer_tax->customer_id = $customer->id;
        if ($request->chkbx_taxable == '1' || $request->chkbx_taxable == 'on') {
            $customer_tax->tax_id = $request->sales_tax_authority;
            $customer_tax->taxable = "1";
        } else {
            if ($request->hasFile('exemp_certificate') && $request->file('exemp_certificate')->isValid()) {
                $fileName = time() . $request->file('exemp_certificate')->getClientOriginalName(); // getting image extension
                $destinationPath = public_path() . "/uploads";
                $request->file('exemp_certificate')->move($destinationPath, $fileName);
                $customer_tax->exempt_certificate = $fileName;
                $customer_tax->taxable = "0";
            }
        }
        $customer_tax->reseller_number = $request->reseller_number;
        $customer_tax->save();
        if ($request->has('customer_items_field')) {
            foreach ($request->customer_items_field as $customer_item_id) {
                $customer_item = new CustomerItem;
                $customer_item->customer_id = $customer->id;
                $customer_item->item_id = $customer_item_id;
                $customer_item->billing_by = $request->price_option;
                $customer_item->custom_price =$request->price_by_weight;
                if ($request->has('chkbx_taxable_item')) {
                    $taxable = $request->chkbx_taxable_item;
                    if (isset($taxable[$customer_item_id])) {
                        $customer_item->taxable = 1;
                    } else {
                        $customer_item->taxable = 0;
                    }
                }
                if ($request->price_option == "0") {
                    $item = Item::find($customer_item_id);
                    $customer_item->price = $item->weight * $request->price_by_weight;
                }
                else if($request->price_option == "1") {
                    $customer_item->price =$request->price_field[$customer_item_id];
                }
                else{
                    if($request->price_field[$customer_item_id]!=""){
                        $customer_item->price =$request->price_field[$customer_item_id];
                    }
                    else{
                        $item = Item::find($customer_item_id);
                        $customer_item->price = $item->weight * $request->price_by_weight;
                    }
                }
                $customer_item->save();
            }
        }
    }

    public function getGetChildren($id) {
        $sql = "select items.id,items.name from items join item_relation on items.id=item_relation.child_id where items.status=1 AND item_relation.parent_id='" . $id . "'";
        $items = DB::select(DB::raw($sql));
        $return = "<select name='child_item' id='child_item'><option value='-1'>Select Item</option>";
        foreach ($items as $item) {
            $return.="<option value='" . $item->id . "'>" . $item->name . "</option>";
        }
        return $return . "</select>";
    }

    public function getItemDetail($id) {
        $item = Item::find($id);
        $sql = "select items.* from items join item_relation on items.id=item_relation.parent_id where items.status=1 AND item_relation.child_id='" . $id . "'";
        $parent_item = DB::select(DB::raw($sql));
        if ($parent_item) {
            $parent_item = $parent_item[0];
        }
        return view('admin.customers.itemDetail', ['item' => $item, "parent" => $parent_item]);
    }

    public function getShow(Request $request) {
		$customers = Customer::all();
		if ($request->has('search_string')) {
			$customers = Customer::where('name', 'like', "%$request->search_string%")->orWhere('customer_number', '=', "$request->search_string")->get();
		}
		
        $data = array();
        foreach ($customers as $customer) {
            $row = array();
            $row["name"] = $customer->name;
            $row["number"] = $customer->customer_number;
            $row["phone"] = $customer->shipping_phone;
            $row["actions"] = '<a href="/admin/customers/edit/' . $customer->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/customers/delete/' . $customer->id . '" data-mode="ajax">Delete</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function getEdit($id) {
        $customer=Customer::find($id);
        $customer_departments =CustomerDepartment::where('customer_id','=',$id)->get();
        $customer_billing = CustomerBilling::where('customer_id','=',$id)->first();
        $customer_tax = CustomerTax::where('customer_id','=',$id)->first();
        $customer_items = CustomerItem::where('customer_id','=',$id)->get();
        $parent_items = DB::select(DB::raw('SELECT items.id,items.name FROM `items` where id not in (select child_id from item_relation) AND items.status=1'));
        $taxes = Tax::all();
        return view('admin.customers.edit', 
                [
                   "customer" => $customer,
                   "customer_departments" => $customer_departments,
                   "customer_billing" => $customer_billing,
                   "customer_tax" => $customer_tax,
                   "customer_items" => $customer_items,
                   "parent_items" => $parent_items,
                   "taxes" => $taxes
                ]);
    }
    public function postEdit($id, Request $request) {
        $customer = Customer::find($id);
        $customer->name = $request->ship_to_name;
        $customer->customer_number = $request->customer_number;
        $customer->billing_address = $customer->shipping_address = $request->ship_to_address;
        $customer->billing_city = $customer->shipping_city = $request->ship_to_city;
        $customer->billing_state = $customer->shipping_state = $request->ship_to_state;
        $customer->billing_zipcode = $customer->shipping_zipcode = $request->ship_to_zipcode;
        $customer->billing_phone = $customer->shipping_phone = $request->phone;
        $customer->billing_fax = $customer->shipping_fax = $request->fax;
        if ($request->has('billing_address') && $request->billing_address == '1') {
            $customer->billing_address = $request->billing_ship_to_address;
            $customer->billing_city = $request->billing_ship_to_city;
            $customer->billing_state = $request->billing_ship_to_state;
            $customer->billing_zipcode = $request->billing_ship_to_zipcode;
            $customer->billing_phone = $request->billing_phone;
            $customer->billing_fax = $request->billing_fax;
        }
        $customer->save();
        CustomerDepartment::where('customer_id','=',$id)->delete();
        if ($request->has('use_department')) {
            foreach ($request->department_list as $list) {
                $customer_department = new CustomerDepartment;
                $customer_department->customer_id = $customer->id;
                $customer_department->department_name = $list;
                $customer_department->save();
            }
        }
        $customer_billing=CustomerBilling::where('customer_id','=',$id)->first();
        $customer_billing->customer_id = $customer->id;
        $customer_billing->bill_type = $request->bill_type;
        $customer_billing->terms = $request->terms;
        $customer_billing->due_date = $request->days_due;
        $customer_billing->save();
        $customer_tax = CustomerTax::where('customer_id','=',$id)->first();
        $customer_tax->customer_id = $customer->id;
        if ($request->chkbx_taxable == '1' || $request->chkbx_taxable == 'on') {
            $customer_tax->tax_id = $request->sales_tax_authority;
            $customer_tax->taxable = "1";
        } else {
            if ($request->hasFile('exemp_certificate') && $request->file('exemp_certificate')->isValid()) {
                $fileName = time() . $request->file('exemp_certificate')->getClientOriginalName(); // getting image extension
                $destinationPath = public_path() . "/uploads";
                $request->file('exemp_certificate')->move($destinationPath, $fileName);
                $customer_tax->exempt_certificate = $fileName;
                $customer_tax->taxable = "0";
            }
        }
        $customer_tax->reseller_number = $request->reseller_number;
        $customer_tax->save();
        CustomerItem::where('customer_id','=',$id)->delete();
        if ($request->has('customer_items_field')) {
            foreach ($request->customer_items_field as $customer_item_id) {
                $customer_item = new CustomerItem;
                $customer_item->customer_id = $customer->id;
                $customer_item->item_id = $customer_item_id;
                $customer_item->billing_by = $request->price_option;
                $customer_item->custom_price =$request->price_by_weight;
                if ($request->has('chkbx_taxable_item')) {
                    $taxable = $request->chkbx_taxable_item;
                    if (isset($taxable[$customer_item_id])) {
                        $customer_item->taxable = 1;
                    } else {
                        $customer_item->taxable = 0;
                    }
                }
                if ($request->price_option == "0") {
                    $item = Item::find($customer_item_id);
                    $customer_item->price = $item->weight * $request->price_by_weight;
                }
                else if($request->price_option == "1") {
                    $customer_item->price =$request->price_field[$customer_item_id];
                }
                else{
                    if($request->price_field[$customer_item_id]!=""){
                        $customer_item->price =$request->price_field[$customer_item_id];
                    }
                    else{
                        $item = Item::find($customer_item_id);
                        $customer_item->price = $item->weight * $request->price_by_weight;
                    }
                }
                $customer_item->save();
            }
        }
    }
    public function getDelete($id) {
        return view('admin.customers.delete', ['id' => $id]);
    }

    public function postDelete($id, Request $request) {
        $customer = Customer::find($id);
        $customer->delete();
    }
   
}
