<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReceivingManifest;
use App\Models\ShipManifest;
use App\Models\Customer;
use App\Models\CustomerDepartment;
class ManifestController extends Controller {

    public function getIndex() {
        $customers = Customer::organization()->get();
        return view('admin.manifests.index', [ 'customers' => $customers]);
    }

    public function getShowShipping(Request $request) {
        if ($request->department != "-1") {
            $ship_manifests = ShipManifest::with('customer')->organization()->where('department_id','=',$request->department)->where('customer_id', '=', $request->name)->whereBetween('shipping_date', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->orderBy('id', 'desc')->skip($request->recordstartindex)->take($request->pagesize)->get();
			$ship_manifests_total = ShipManifest::with('customer')->organization()->where('department_id','=',$request->department)->where('customer_id', '=', $request->name)->whereBetween('shipping_date', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->get();
        } else {
            $ship_manifests = ShipManifest::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('shipping_date', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->orderBy('id', 'desc')->skip($request->recordstartindex)->take($request->pagesize)->get();
			$ship_manifests_total = ShipManifest::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('shipping_date', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->get();
        }
        $dataa = array();
        foreach ($ship_manifests as $manifest) {
            $row = array();
            $row["id"] = $manifest->manifest_number;
            $row["name"] = $manifest->customer->name;
            $department=CustomerDepartment::find($manifest->department_id);
            if($department){
                $row["department"] = $department->department_name;
            }
            else{
                $row["department"] = '';
            }
            $row["date"] = date('d F, Y', strtotime($manifest->shipping_date));
            if($manifest->invoiced==1){
                $row["invoiced"] = "Yes";  
            }
            else{
                $row["invoiced"] = "No";  
            }
            $row["actions"] = '<a href="/admin/shiping-manifest/show-receipt/' . $manifest->id . '">View</a>';
            if($manifest->shipping_date==date("Y-m-d",time())){
                $row["actions"].= ' | <a href="/admin/shiping-manifest/edit/' . $manifest->id . '">Edit</a>';
            }
			
			$dataa[] = $row;
        }
        
		$data[] = array(
			'TotalRows' => $ship_manifests_total->count(),
			'Rows' => $dataa
		);
		echo json_encode($data);
    }

    public function getShowReceiving(Request $request) {
        if ($request->name != "-1") {
            $receiving_manifests = ReceivingManifest::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('created_at', [date("Y-m-d 00:00:00", strtotime($request->start_date)), date("Y-m-d 23:59:59", strtotime($request->end_date))])->orderBy('id', 'desc')->skip($request->recordstartindex)->take($request->pagesize)->get();
			$receiving_manifests_total = ReceivingManifest::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('created_at', [date("Y-m-d 00:00:00", strtotime($request->start_date)), date("Y-m-d 23:59:59", strtotime($request->end_date))])->get();
        } else {
            $receiving_manifests = ReceivingManifest::with('customer')->organization()->whereBetween('created_at', [date("Y-m-d 00:00:00", strtotime($request->start_date)), date("Y-m-d 23:59:59", strtotime($request->end_date))])->orderBy('id', 'desc')->skip($request->recordstartindex)->take($request->pagesize)->get();
			$receiving_manifests_total = ReceivingManifest::with('customer')->organization()->whereBetween('created_at', [date("Y-m-d 00:00:00", strtotime($request->start_date)), date("Y-m-d 23:59:59", strtotime($request->end_date))])->get();
        }
        $dataa = array();
        foreach ($receiving_manifests as $manifest) {
            $row = array();
            $row["id"] = $manifest->manifest_number;
            $row["name"] = $manifest->customer->name;
            $department=CustomerDepartment::find($manifest->department_id);
            if($department){
                $row["department"] =$department->department_name;
            }
            else{
                $row["department"] ='';
            }
            $row["date"] = date('d F, Y', strtotime($manifest->created_at));
            $row["actions"] = '<a href="/admin/receiving-manifest/show-receipt/' . $manifest->id . '">View</a>';
            $dataa[] = $row;
        }
        
		$data[] = array(
			'TotalRows' => $receiving_manifests_total->count(),
			'Rows' => $dataa
		);
		echo json_encode($data);
    }

}
