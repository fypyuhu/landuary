<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDepartment extends Model
{
    protected $table="customers_departments";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }

}
