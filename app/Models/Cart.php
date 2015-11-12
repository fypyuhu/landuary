<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $table = "carts";

    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
