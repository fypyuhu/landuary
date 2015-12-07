<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class TaxComponent extends Model {

    protected $table = "taxes_components";

    public function save(array $options = array()) {
        $this->organization_id = Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }

    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }

}
