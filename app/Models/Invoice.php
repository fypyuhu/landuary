<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Invoice extends Model
{
    protected $table = "invoices";
    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }
    protected $dates = ['created_at', 'updated_at', 'due_date'];
    public function save(array $options = array()) {
        $this->organization_id=Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }
    public static function getInvoicePriceByManifestIds($manifest_ids,$customer_id){
        $sql="select items.name as item_name,items.id as item_id,shipping_manifest.shipping_date,outgoing_carts.net_weight,customers_items.taxable,customers_outgoing_carts_items.quantity,customers_outgoing_carts_items.id as customer_item_id,shipping_manifest.id, outgoing_carts.id as cart_id,customers_items.price, customers_items.billing_by,customers_items.custom_price, items.weight "
                . "from shipping_manifest "
                . "join outgoing_carts on FIND_IN_SET (outgoing_carts.id, shipping_manifest.outgoing_cart_id) "
                . "join customers_outgoing_carts_items on customers_outgoing_carts_items.outgoing_cart_id = outgoing_carts.id "
                . "join items on items.id=customers_outgoing_carts_items.item_id "
                . "join customers_items on customers_items.item_id=items.id "
                . "where FIND_IN_SET(shipping_manifest.id,'".$manifest_ids."') and customers_items.customer_id='".$customer_id."' "
                . "order by shipping_manifest.id ASC";
         return  DB::select(DB::raw($sql));
    }
    public function customer() {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public static function profitByCutomer(){
        $sql="select customers.name, sum(total_price) as total_price from customers "
           . "left join invoices on invoices.customer_id=customers.id "
           . "where customers.organization_id='".Auth::user()->organization_id."' "
           . "group by customers.id ";
        return  DB::select(DB::raw($sql));
    }
}
