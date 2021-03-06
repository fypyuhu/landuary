<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Item extends Model {

    protected $table = "items";
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];

    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }

    public function save(array $options = array()) {
        $this->organization_id=Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }

}
