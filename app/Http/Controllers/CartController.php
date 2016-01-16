<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;

class CartController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        return view('admin.carts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate() {
        $customers = Customer::organization()->get();
        return view('admin.carts.add', [ 'customers' => $customers, 'get_max_number' => $this->generateAutoNumber()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request) {
        $cart = new Cart;
        $cart->cart_number = $request->cart_number;
        $cart->tare_weight = $request->tare_weight;
        $cart->status = $request->status;
        $cart->cart_current_location = $request->cart_current_location;
        if ($request->has('use_as_exchange_cart')) {
            $cart->customer_number = $request->customer_number;
            $cart->use_as_exchange_cart = $request->use_as_exchange_cart;
        }
        $cart->save();
    }

    public function getShow(Request $request) {
        $carts = Cart::organization()->where('is_deleted', '=', '1')->get();
        $data = array();
        foreach ($carts as $cart) {
            $row = array();
            $row["cart_number"] = $cart->cart_number;
            $row["tare_weight"] = $cart->tare_weight;
            $row["status"] = $cart->status;
            $row["use_as_exchange_cart"] = $cart->use_as_exchange_cart;
            $row["actions"] = '<a data-mode="ajax" href="/admin/carts/edit/' . $cart->id . '">Edit</a> / <a data-mode="ajax" href="/admin/carts/delete/' . $cart->id . '">Delete</a>';
            $data[] = $row;
        }

        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Custom Functions
     */
    private function generateAutoNumber() {
        $max_cart_number = Cart::max('cart_number');
        return $max_cart_number + 1;
    }

    /**
     * End Custom Functions
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id) {
        return view('admin.carts.edit', ['cart' => Cart::find($id)]);
    }

    public function postEdit($id, Request $request) {
        $cart = Cart::find($id);
        $cart->cart_number = $request->cart_number;
        //$cart->use_as_exchange_cart = $request->use_as_exchange_cart;
        $cart->tare_weight = $request->tare_weight;
        $cart->status = $request->status;
        //$cart->cart_current_location = $request->cart_current_location;
        //$cart->customer_number = $request->customer_number;
        $cart->save();
    }

    public function getDelete($id) {
        return view('admin.carts.delete', ['id' => $id]);
    }

    public function postDelete($id) {
        $cart = Cart::find($id);
        $cart->is_deleted = 0;
        $cart->save();
    }
	
	public function getMachineWeight() {
		$myfile = fopen('C:\weight.txt', "r") or die("Unable to open file!");
		$value = fread($myfile,filesize('C:\weight.txt'));
		fclose($myfile);
		return $value;
	}

}
