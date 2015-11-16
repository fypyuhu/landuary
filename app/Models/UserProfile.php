<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = "user_profile";
    public function scopeOrganization($query) {
        return $query->where('organization', 1);
    }
}
