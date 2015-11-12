<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerItem extends Model
{
    protected $table="customers_items";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
