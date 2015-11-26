<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\IncomingCart;
use App\Models\OutgoingCart;
use App\Models\Customer;

class CartsListController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $customers = Customer::all();
        return view('admin.carts-list.index', ['customers' => $customers ]);
    }

    public function getShowIncoming(Request $request) {
        $incoming_carts = IncomingCart::inCartsList($request);
        $data = array();
        foreach ($incoming_carts as $cart) {
            $row = array();
            $row["incoming_cart_id"] = $cart->incoming_cart_id;
            $row["receiving_date"] = $cart->receiving_date;
			$row["customer_name"] = $cart->name;
            $row["customer_number"] = $cart->customer_number;
            $row["department_name"] = $cart->department_name;
            $row["number_of_items"] = $cart->number_of_items;
            $row["net_weight"] = $cart->net_weight;
            $row["gross_weight"] = $cart->gross_weight;
            $row["invoiced"] = 'No';
            $row["actions"] = '<a href="/admin/in/receipt/' . $cart->id . '" >View</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function getShowOutgoing(Request $request) {
        $outgoing_carts = OutgoingCart::outCartsList($request);
        $data = array();
        foreach ($outgoing_carts as $cart) {
            $row = array();
            $row["outgoing_cart_id"] = $cart->outgoing_cart_id;
            $row["shipping_date"] = $cart->shipping_date;
			$row["customer_name"] = $cart->name;
            $row["customer_number"] = $cart->customer_number;
            $row["department_name"] = $cart->department_name;
            $row["number_of_items"] = $cart->number_of_items;
            $row["net_weight"] = $cart->net_weight;
            $row["gross_weight"] = $cart->gross_weight;
            $row["is_exchange_cart"] = $cart->is_exchange_cart > 0 ? 'Yes' : 'No';
            $row["actions"] = '<a href="/admin/out/receipt/' . $cart->id . '" data-mode="ajax">View</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function getShowReady(Request $request) {
        $outgoing_carts = OutgoingCart::readyCartsList($request);
        $data = array();
        foreach ($outgoing_carts as $cart) {
            $row = array();
            $row["outgoing_cart_id"] = $cart->outgoing_cart_id;
            $row["shipping_date"] = $cart->shipping_date;
			$row["customer_name"] = $cart->name;
            $row["customer_number"] = $cart->customer_number;
            $row["department_name"] = $cart->department_name;
            $row["number_of_items"] = $cart->number_of_items;
            $row["net_weight"] = $cart->net_weight;
            $row["gross_weight"] = $cart->gross_weight;
            $row["is_exchange_cart"] = $cart->is_exchange_cart > 0 ? 'Yes' : 'No';
            $row["actions"] = '<a href="/admin/out/receipt/' . $cart->id . '" data-mode="ajax">View</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
