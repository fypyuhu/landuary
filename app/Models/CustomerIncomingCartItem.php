<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class CustomerIncomingCartItem extends Model {

    protected $table = "customers_incoming_carts_items";

    public static function getItems($id) {
        return DB::select(DB::raw('Select items.*,customers_incoming_carts_items.quantity from customers_incoming_carts_items
           join items on items.id=customers_incoming_carts_items.item_id
           where items.organization_id="'.Auth::user()->organization_id.'" AND customers_incoming_carts_items.incoming_cart_id=' . $id));
    }

    public function save(array $options = array()) {
        $this->organization_id = Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }

    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }

}
