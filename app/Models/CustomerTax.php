<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTax extends Model
{
    protected $table="customers_taxes";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
