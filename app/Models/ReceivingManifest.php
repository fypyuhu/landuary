<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class ReceivingManifest extends Model {

    protected $table = "receiving_manifest";

    public static function getCustomerByIncomingCart() {
        return DB::table('customers')->whereExists(function ($query) {
                    $query->select(DB::raw('customer_id'))
                            ->from('incoming_carts')
                            ->where('customers.organization_id','=',Auth::user()->organization_id)
                            ->whereRaw('incoming_carts.customer_id = customers.id');
                })->get();
    }

    public static function getCustomerIncomingCartItems($customer_id, $date1, $date2, $department_id) {
		$department_where = $department_id > 0 ? "and cd.id = $department_id" : '';
        return DB::select(DB::raw("SELECT * FROM incoming_carts ic LEFT JOIN customers_departments cd ON ic.department_id = cd.id, customers_incoming_carts_items cici, items i WHERE ic.organization_id='".Auth::user()->organization_id."' AND ic.id = cici.incoming_cart_id and cici.item_id = i.id and ic.status='In' and (ic.receiving_date between '$date1' and '$date2') and ic.customer_id = $customer_id and ic.invoiced <= 0 $department_where ORDER BY ic.id"));
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function save(array $options = array()) {
        $this->organization_id = Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }

    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }

}
