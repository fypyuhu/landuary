<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CustomerOutgoingCartItem extends Model {

    protected $table = "customers_outgoing_carts_items";

    public static function getCartItemsById($id) {
        return DB::select(DB::raw('SELECT   
                                 "100" as tare_weight,@curRow := @curRow + 1 AS row_number, 
                                outgoing_carts.id,items.weight,items.name,
                                items.item_number,customers_outgoing_carts_items.quantity,
                                outgoing_carts.net_weight 
                                FROM shipping_manifest 
        join (SELECT @curRow := 0) r 
        join outgoing_carts on FIND_IN_SET( outgoing_carts.id,shipping_manifest.outgoing_cart_id) 
        join customers_outgoing_carts_items on customers_outgoing_carts_items.outgoing_cart_id=outgoing_carts.id 
        join items on customers_outgoing_carts_items.item_id=items.id 
        where shipping_manifest.id=' . $id));
    }
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }
    public static function getItems($id){
       return  DB::select(DB::raw('Select items.*,customers_outgoing_carts_items.quantity from customers_outgoing_carts_items
           join items on items.id=customers_outgoing_carts_items.item_id
           where customers_outgoing_carts_items.outgoing_cart_id=' . $id));
    }
}
