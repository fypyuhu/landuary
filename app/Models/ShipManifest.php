<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipManifest extends Model
{
    protected $table = "shipping_manifest";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }
	
	public function customer()
    {
		return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
