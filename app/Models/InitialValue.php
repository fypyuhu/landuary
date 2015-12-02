<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class InitialValue extends Model
{
    protected $table = "initial_values";
    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }
}
