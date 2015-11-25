<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OutgoingCart extends Model {

    protected $table = "outgoing_carts";

    public static function outCartsList($request) {
        $sql = "SELECT SUM(cici.quantity) AS number_of_items, ic.id,ic.shipping_date, cd.department_name, cici.outgoing_cart_id, c.customer_number, ic.gross_weight, ic.net_weight, ic.status, ic.is_exchange_cart FROM customers_outgoing_carts_items cici, customers c, outgoing_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id 
                    WHERE ic.shipping_date BETWEEN '" . date("Y-m-d", strtotime($request->start_date)) . "' AND '" . date("Y-m-d", strtotime($request->end_date)) . "' ";
        if ($request->name != "-1") {
            $sql.=" AND c.id='" . $request->name . "' ";
        }
        $sql.=" AND  ic.status='Out' AND ic.id = cici.outgoing_cart_id and ic.customer_id = c.id GROUP BY cici.outgoing_cart_id ORDER BY ic.id";
        return DB::select(DB::raw($sql));
    }

    public static function readyCartsList($request) {
        $sql = "SELECT SUM(cici.quantity) AS number_of_items, ic.id, ic.shipping_date, cd.department_name, cici.outgoing_cart_id, c.customer_number, ic.gross_weight, ic.net_weight, ic.status, ic.is_exchange_cart FROM customers_outgoing_carts_items cici, customers c, outgoing_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id 
                    WHERE ic.shipping_date BETWEEN '" . date("Y-m-d", strtotime($request->start_date)) . "' AND '" . date("Y-m-d", strtotime($request->end_date)) . "' ";
        if ($request->name != "-1") {
            $sql.=" AND c.id='" . $request->name . "' ";
        }
        $sql.=" AND  ic.status='Ready' AND ic.id = cici.outgoing_cart_id and ic.customer_id = c.id GROUP BY cici.outgoing_cart_id ORDER BY ic.id";
        return DB::select(DB::raw($sql));
    }

    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
