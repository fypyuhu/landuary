<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxComponent extends Model
{
    protected $table = "taxes_components";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
