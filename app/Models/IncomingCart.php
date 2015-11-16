<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IncomingCart extends Model
{
    protected $table = "incoming_carts";
	
	public static function inCartsList(){
		return DB::select(DB::raw("SELECT SUM(cici.quantity) AS number_of_items, ic.receiving_date, cd.department_name, cici.incoming_cart_id, c.customer_number, ic.gross_weight, ic.net_weight FROM customers_incoming_carts_items cici, customers c, incoming_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id WHERE ic.id = cici.incoming_cart_id and ic.customer_id = c.id GROUP BY cici.incoming_cart_id ORDER BY ic.id"));
	}
}
