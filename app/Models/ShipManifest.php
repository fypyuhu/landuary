<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

}
