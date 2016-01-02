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
        $sql="select items.name as item_name,items.id as item_id, items.item_number, shipping_manifest.shipping_date,outgoing_carts.net_weight,customers_items.taxable,customers_outgoing_carts_items.quantity,customers_outgoing_carts_items.id as customer_item_id,shipping_manifest.id, outgoing_carts.id as cart_id, outgoing_carts.cart_id as cart_number,customers_items.price, customers_items.billing_by,customers_items.custom_price, items.weight "
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
    public static function getReconciliationShippingData($request){
         $sql="SELECT shipping_manifest.shipping_date, sum(net_weight) as out_weight FROM `shipping_manifest` "
              . "join outgoing_carts on FIND_IN_SET(outgoing_carts.id,shipping_manifest.outgoing_cart_id) "
                 . "where shipping_manifest.shipping_date between '".Date("Y-m-d H:s:i",strtotime($request->start_date))."' and '".Date("Y-m-d H:s:i",strtotime($request->end_date))."' "
                 . "and shipping_manifest.customer_id='".$request->customer."' "
                 . "group by shipping_manifest.shipping_date ";
        return  DB::select(DB::raw($sql));
    }
    public static function getReconciliationReceivingData($request){
         $sql="SELECT DATE_FORMAT(receiving_manifest.created_at,'%Y-%m-%d') as shipping_date, sum(incoming_carts.net_weight) as in_weight FROM `receiving_manifest` "
            . "join incoming_carts on FIND_IN_SET(incoming_carts.id,receiving_manifest.incoming_cart_ids) "
            . "where receiving_manifest.created_at between '".Date("Y-m-d H:s:i",strtotime($request->start_date." 00:00:00"))."' and '".Date("Y-m-d H:s:i",strtotime($request->end_date." 23:59:59"))."' "
            . "and receiving_manifest.customer_id='".$request->customer."' "
            . "group by receiving_manifest.created_at ";
        return  DB::select(DB::raw($sql));
    }
    public static function getReconciliationData($request){
         $sql="SELECT in_weight ,in_date,out_date,out_weight"
                 . " FROM (SELECT shipping_manifest.shipping_date as out_date, sum(net_weight) as out_weight FROM `shipping_manifest` "
              . "join outgoing_carts on FIND_IN_SET(outgoing_carts.id,shipping_manifest.outgoing_cart_id) "
                 . "where shipping_manifest.shipping_date between '".Date("Y-m-d H:s:i",strtotime($request->start_date))."' and '".Date("Y-m-d H:s:i",strtotime($request->end_date))."' "
                 . "and shipping_manifest.customer_id='".$request->customer."' "
                 . "group by shipping_manifest.shipping_date order by shipping_manifest.shipping_date) A "
                 . "Left JOIN "
            . "(SELECT DATE_FORMAT(receiving_manifest.created_at,'%Y-%m-%d') as in_date, sum(incoming_carts.net_weight) as in_weight FROM `receiving_manifest` "
            . "join incoming_carts on FIND_IN_SET(incoming_carts.id,receiving_manifest.incoming_cart_ids) "
            . "where receiving_manifest.created_at between '".Date("Y-m-d H:s:i",strtotime($request->start_date." 00:00:00"))."' and '".Date("Y-m-d H:s:i",strtotime($request->end_date." 23:59:59"))."' "
            . "and receiving_manifest.customer_id='".$request->customer."' "
            . "group by receiving_manifest.created_at order by receiving_manifest.created_at) B on B.in_date=A.out_date";
        return  DB::select(DB::raw($sql));
    }
}
