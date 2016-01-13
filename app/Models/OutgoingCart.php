<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class OutgoingCart extends Model {

    protected $table = "outgoing_carts";
    protected $dates = ['created_at', 'updated_at', 'shipping_date'];
    public static function outCartsList($request) {
        $sql = "SELECT SQL_CALC_FOUND_ROWS sm.manifest_number, SUM(cici.quantity) AS number_of_items,ic.invoiced, ic.id,ic.cart_id,ic.shipping_date, cd.department_name, cici.outgoing_cart_id, c.name, c.customer_number, ic.gross_weight, ic.net_weight, ic.status, ic.is_exchange_cart FROM shipping_manifest sm, customers_outgoing_carts_items cici, customers c, outgoing_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id 
                    WHERE ic.shipping_date BETWEEN '" . date("Y-m-d", strtotime($request->start_date)) . "' AND '" . date("Y-m-d 23:59:59", strtotime($request->end_date)) . "' ";
        if ($request->name != "-1") {
            $sql.=" AND c.id='" . $request->name . "' ";
        }
        $sql.=" AND ic.organization_id = '".Auth::user()->organization_id."'  AND  ic.status='Out' AND ic.id = cici.outgoing_cart_id and ic.customer_id = c.id and sm.outgoing_cart_id = ic.id GROUP BY cici.outgoing_cart_id ORDER BY ic.id DESC limit ".$request->recordstartindex.", ".$request->pagesize;
        return DB::select(DB::raw($sql));
    }

    public static function readyCartsList($request) {
        $sql = "SELECT SQL_CALC_FOUND_ROWS SUM(cici.quantity) AS number_of_items, ic.id,ic.cart_id, ic.shipping_date, cd.department_name, cici.outgoing_cart_id, c.name, c.customer_number, ic.gross_weight, ic.net_weight, ic.status, ic.is_exchange_cart FROM customers_outgoing_carts_items cici, customers c, outgoing_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id 
                    WHERE ic.shipping_date BETWEEN '" . date("Y-m-d", strtotime($request->start_date)) . "' AND '" . date("Y-m-d 23:59:59", strtotime($request->end_date)) . "' ";
        if ($request->name != "-1") {
            $sql.=" AND c.id='" . $request->name . "' ";
        }
        $sql.=" AND ic.organization_id = '".Auth::user()->organization_id."'  AND  ic.status='Ready' AND ic.id = cici.outgoing_cart_id and ic.customer_id = c.id GROUP BY cici.outgoing_cart_id ORDER BY ic.id DESC limit ".$request->recordstartindex.", ".$request->pagesize;
        return DB::select(DB::raw($sql));
    }

     public function save(array $options = array()) {
        $this->organization_id = Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }
    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }
}
