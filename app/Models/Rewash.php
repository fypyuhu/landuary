<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;

class Rewash extends Model
{
    protected $table = 'rewash';
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	public static function rewashList($request) {
		$limit = '';
		if($request->has('recordstartindex')) {
			$limit =  "limit ".$request->recordstartindex.", ".$request->pagesize;
		}
		$sql = "SELECT SQL_CALC_FOUND_ROWS SUM(ri.quantity) AS number_of_items, r.id, r.rewash_date, cd.department_name, ri.rewash_id, c.name, c.customer_number, r.total_weight FROM rewash_items ri, customers c, rewash r LEFT JOIN customers_departments cd ON r.department_id = cd.id 
                        WHERE r.rewash_date BETWEEN '" . date("Y-m-d", strtotime($request->start_date)) . "' AND '" . date("Y-m-d", strtotime($request->end_date)) . "' ";
        if ($request->name != "-1") {
            $sql.=" AND c.id='" . $request->name . "' ";
        }
        $sql.=" AND r.organization_id = '".Auth::user()->organization_id."' AND r.id = ri.rewash_id and r.customer_id = c.id AND r.deleted_at is NULL GROUP BY ri.rewash_id ORDER BY r.id DESC $limit";
        return DB::select(DB::raw($sql));
	}
	
	public function save(array $options = array()) {
        $this->organization_id = Auth::user()->organization_id;
        parent::save($options); // Calls Default Save
    }

    public function scopeOrganization($query) {
        return $query->where('organization_id', Auth::user()->organization_id);
    }
}