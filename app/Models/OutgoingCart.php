<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingCart extends Model
{
    protected $table = "outgoing_carts";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
