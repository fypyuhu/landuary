<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = "taxes";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
