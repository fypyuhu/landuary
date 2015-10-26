<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('admin.carts', ['carts' => Cart::all()]);
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
    public function postCreate(Request $request)
    {
        $cart = new cart;
		$cart->number = $request->number;
		$cart->use_as_exchange_cart = $request->use_as_exchange_cart;
		$cart->tare_weight = $request->tare_weight;
		$cart->status = $request->status;
		$cart->cart_current_location = $request->cart_current_location;
		$cart->customer_number = $request->customer_number;
		$cart->save();
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow(Request $request)
    {
        $carts = DB::select(DB::raw('SELECT * FROM `carts`'));

        $data = array();
        foreach ($carts as $cart) {
            $row = array();
            $row["number"] = $cart->number;
            $row["tare_weight"] = $cart->tare_weight;
            $row["status"] = $cart->status;
            $row["use_as_exchange_cart"] = $cart->use_as_exchange_cart;
            $row["actions"] = '<a href="">Edit</a> / <a href="">Delete</a>';
            $data[] = $row;
        }
		
        echo "{\"data\":" . json_encode($data) . "}";
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
