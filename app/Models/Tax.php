<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Tax extends Model
{
    protected $table = "taxes";
    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }
    public function save(array $options = array()) {
        $this->organization_id=Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }
    public static function getTaxRateById($tax_id){
        $sql="SELECT taxes.tax_rate,sum(taxes_components.tax_rate) as accumulative_rate, taxes.tax_type from taxes "
                . "join taxes_components on taxes_components.tax_id=taxes.id "
                . "where taxes.id='".$tax_id."'";
        return  DB::select(DB::raw($sql));
    }
    public function components()
    {
        return $this->hasMany('App\Models\TaxComponent','tax_id');
    }
}
