<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceivingManifest extends Model
{
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
