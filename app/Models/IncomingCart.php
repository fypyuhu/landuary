<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class IncomingCart extends Model {

    protected $table = "incoming_carts";
    protected $dates = ['created_at', 'updated_at', 'receiving_date'];
    public static function inCartsList($request) {
        $sql = "SELECT SUM(cici.quantity) AS number_of_items, ic.id,ic.receiving_date, cd.department_name, cici.incoming_cart_id, c.name, c.customer_number, ic.gross_weight, ic.net_weight, ic.cart_id FROM customers_incoming_carts_items cici, customers c, incoming_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id 
                        WHERE ic.receiving_date BETWEEN '" . date("Y-m-d", strtotime($request->start_date)) . "' AND '" . date("Y-m-d", strtotime($request->end_date)) . "' ";
        if ($request->name != "-1") {
            $sql.=" AND c.id='" . $request->name . "' ";
        }
        $sql.=" AND ic.organization_id = '".Auth::user()->organization_id."' AND ic.id = cici.incoming_cart_id and ic.customer_id = c.id GROUP BY cici.incoming_cart_id ORDER BY ic.id";
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
