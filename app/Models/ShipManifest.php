<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class ShipManifest extends Model {

    protected $table = "shipping_manifest";

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
    public static function getManifestsForInvoice($customer_id,$department_ids){
        $sql='Select shipping_manifest.id,customers_departments.department_name,shipping_manifest.outgoing_cart_id,shipping_manifest.shipping_date FROM shipping_manifest'
                . ' LEFT JOIN customers_departments on customers_departments.id=shipping_manifest.department_id'
                . ' WHERE shipping_manifest.customer_id="'.$customer_id.'" '
                . ' AND shipping_manifest.invoiced=0 '
                .' AND FIND_IN_SET(shipping_manifest.department_id,"'.$department_ids.'") ';
        
        return  DB::select(DB::raw($sql));
    }
}
