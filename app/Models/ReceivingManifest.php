<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReceivingManifest extends Model
{
	protected $table = "receiving_manifest";
	
	public static function getCustomerByIncomingCart() {
		return DB::table('customers')->whereExists(function ($query) {
										$query->select(DB::raw('customer_id'))
											  ->from('incoming_carts')
											  ->whereRaw('incoming_carts.customer_id = customers.id');
									})->get();
	}
	
	public static function getCustomerIncomingCartItems($customer_id, $date1, $date2) {
		return DB::select(DB::raw("SELECT * FROM incoming_carts ic, customers_incoming_carts_items cici, items i WHERE ic.id = cici.incoming_cart_id and cici.item_id = i.id and ic.status='In' and (receiving_date between '$date1' and '$date2') and ic.customer_id = $customer_id ORDER BY ic.id"));
	}
	
	public function customer()
    {
		return $this->hasOne('App\Models\Customer', 'id');
    }
	
    /*public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }*/

}
