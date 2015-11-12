<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBilling extends Model
{
    protected $table="customers_billings"; 
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
