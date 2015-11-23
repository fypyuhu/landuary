<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IncomingCart extends Model
{
    protected $table = "incoming_carts";
	
	public static function inCartsList($request){
            $sql="SELECT SUM(cici.quantity) AS number_of_items, ic.id,ic.receiving_date, cd.department_name, cici.incoming_cart_id, c.customer_number, ic.gross_weight, ic.net_weight FROM customers_incoming_carts_items cici, customers c, incoming_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id 
                        WHERE ic.receiving_date BETWEEN '".date("Y-m-d",strtotime($request->start_date))."' AND '".date("Y-m-d",strtotime($request->end_date))."' ";
            if($request->name!="-1"){
                $sql.=" AND c.id='".$request->name."' ";
            }
            $sql.=" AND ic.id = cici.incoming_cart_id and ic.customer_id = c.id GROUP BY cici.incoming_cart_id ORDER BY ic.id";
            return DB::select(DB::raw($sql));
	}
}
