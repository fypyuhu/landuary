<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IncomingCart;
use App\Models\OutgoingCart;
use App\Models\Customer;
use DB;

class CartsListController extends Controller {

    public function getIndex() {
        $customers = Customer::organization()->get();
        return view('admin.carts-list.index', ['customers' => $customers]);
    }

    public function getShowIncoming(Request $request) {
        $incoming_carts = IncomingCart::inCartsList($request);
		$sql = DB::select(DB::raw("SELECT FOUND_ROWS() AS `found_rows`;"));
		$total_rows = $sql[0]->found_rows;
        $dataa = array();
        foreach ($incoming_carts as $cart) {
            $row = array();
            $row["incoming_cart_id"] = $cart->cart_id;
            $row["receiving_date"] = date('d F, Y', strtotime($cart->receiving_date));
            $row["customer_name"] = $cart->name;
            //$row["customer_number"] = $cart->customer_number;
            $row["department_name"] = $cart->department_name;
            $row["number_of_items"] = $cart->number_of_items;
            $row["net_weight"] = $cart->net_weight;
            //$row["gross_weight"] = $cart->gross_weight;
            $row["actions"] = '<a href="/admin/in/show-receipt/' . $cart->id . '" >View</a>
                               | <a href="/admin/in/edit/' . $cart->id . '" >Edit</a>';
            $dataa[] = $row;
        }
		
        $data[] = array(
			'TotalRows' => $total_rows,
			'Rows' => $dataa
		);
		echo json_encode($data);
    }

    public function getShowOutgoing(Request $request) {
        $outgoing_carts = OutgoingCart::outCartsList($request);
		$sql = DB::select(DB::raw("SELECT FOUND_ROWS() AS `found_rows`;"));
		$total_rows = $sql[0]->found_rows;
        $dataa = array();
        foreach ($outgoing_carts as $cart) {
            $row = array();
            $row["outgoing_cart_id"] = $cart->cart_id;
            $row["shipping_date"] = date('d F, Y', strtotime($cart->shipping_date));
            $row["customer_name"] = $cart->name;
            //$row["customer_number"] = $cart->customer_number;
			$row["manifest_number"] = $cart->manifest_number;
            $row["department_name"] = $cart->department_name;
            $row["number_of_items"] = $cart->number_of_items;
            $row["net_weight"] = $cart->net_weight;
            //$row["gross_weight"] = $cart->gross_weight;
            $row["is_exchange_cart"] = $cart->is_exchange_cart > 0 ? 'Yes' : 'No';
            $row["invoiced"] = $cart->invoiced > 0 ? 'Yes' : 'No';
            $row["actions"] = '<a href="/admin/out/show-receipt/' . $cart->id . '" >View</a>';
            if($cart->invoiced<1){
                $row["actions"].='| <a href="/admin/out/edit/' . $cart->id . '" >Edit</a>';
            }
            $dataa[] = $row;
        }
		
        $data[] = array(
			'TotalRows' => $total_rows,
			'Rows' => $dataa
		);
		echo json_encode($data);
    }

    public function getShowReady(Request $request) {
        $outgoing_carts = OutgoingCart::readyCartsList($request);
		$sql = DB::select(DB::raw("SELECT FOUND_ROWS() AS `found_rows`;"));
		$total_rows = $sql[0]->found_rows;
        $dataa = array();
        foreach ($outgoing_carts as $cart) {
            $row = array();
            $row["outgoing_cart_id"] = $cart->cart_id;
            $row["shipping_date"] = date('d F, Y', strtotime($cart->shipping_date));
            $row["customer_name"] = $cart->name;
            //$row["customer_number"] = $cart->customer_number;
            $row["department_name"] = $cart->department_name;
            $row["number_of_items"] = $cart->number_of_items;
            $row["net_weight"] = $cart->net_weight;
            //$row["gross_weight"] = $cart->gross_weight;
            $row["is_exchange_cart"] = $cart->is_exchange_cart > 0 ? 'Yes' : 'No';
            $row["actions"] = '<a href="/admin/out/show-receipt/' . $cart->id . '" >View</a>
                               | <a href="/admin/out/edit/' . $cart->id . '" >Edit</a>
							   | <a href="/admin/out/delete/' . $cart->id . '" data-mode="ajax">Delete</a>';
            $dataa[] = $row;
        }
		
        $data[] = array(
			'TotalRows' => $total_rows,
			'Rows' => $dataa
		);
		echo json_encode($data);
    }

}
