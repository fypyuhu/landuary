<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OutgoingCart extends Model
{
    protected $table = "outgoing_carts";
	
	public static function outCartsList(){
		return DB::select(DB::raw("SELECT SUM(cici.quantity) AS number_of_items, ic.shipping_date, cd.department_name, cici.outgoing_cart_id, c.customer_number, ic.gross_weight, ic.net_weight, ic.status, ic.is_exchange_cart FROM customers_outgoing_carts_items cici, customers c, outgoing_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id WHERE ic.id = cici.outgoing_cart_id and ic.customer_id = c.id GROUP BY cici.outgoing_cart_id ORDER BY ic.id"));
	}
        public static function readyCartsList(){
		return DB::select(DB::raw("SELECT SUM(cici.quantity) AS number_of_items, ic.shipping_date, cd.department_name, cici.outgoing_cart_id, c.customer_number, ic.gross_weight, ic.net_weight, ic.status, ic.is_exchange_cart FROM customers_outgoing_carts_items cici, customers c, outgoing_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id WHERE ic.id = cici.outgoing_cart_id and ic.status='Ready' and ic.customer_id = c.id GROUP BY cici.outgoing_cart_id ORDER BY ic.id"));
	}
	
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
