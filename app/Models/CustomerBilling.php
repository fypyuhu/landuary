<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class CustomerBilling extends Model {

    protected $table = "customers_billings";

    public function save(array $options = array()) {
        $this->organization_id = Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }

    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }

}
