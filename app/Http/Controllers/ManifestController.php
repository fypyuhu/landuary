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
            $ship_manifests = ShipManifest::with('customer')->organization()->where('department_id','=',$request->department)->where('customer_id', '=', $request->name)->whereBetween('shipping_date', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->skip($request->recordstartindex)->take($request->pagesize)->get();
        } else {
            $ship_manifests = ShipManifest::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('shipping_date', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->skip($request->recordstartindex)->take($request->pagesize)->get();
        }
        $data = array();
        foreach ($ship_manifests as $manifest) {
            $row = array();
            $row["id"] = $manifest->id;
            $row["name"] = $manifest->customer->name;
            $department=CustomerDepartment::find($manifest->department_id);
            if($department){
                $row["department"] =$department->department_name;
            }
            else{
                $row["department"] ='';
            }
            $row["date"] = $manifest->shipping_date;
            $row["actions"] = '<a href="/admin/shiping-manifest/recipt/' . $manifest->id . '">View</a>';
            if($manifest->shipping_date==date("Y-m-d",time())){
                $row["actions"].= ' | <a href="/admin/shiping-manifest/edit/' . $manifest->id . '">Edit</a>';
            }
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    public function getShowReceiving(Request $request) {
        if ($request->name != "-1") {
            //$receiving_manifests = ReceivingManifest::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('created_at', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->skip($request->recordstartindex)->take($request->pagesize)->get();
			$receiving_manifests = ReceivingManifest::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('created_at', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->get();
        } else {
            $receiving_manifests = ReceivingManifest::with('customer')->organization()->whereBetween('created_at', [date("Y-m-d", strtotime($request->start_date)), date("Y-m-d", strtotime($request->end_date))])->skip($request->recordstartindex)->take($request->pagesize)->get();
        }
        $data = array();
        foreach ($receiving_manifests as $manifest) {
            $row = array();
            $row["id"] = $manifest->id;
            $row["name"] = $manifest->customer->name;
            $department=CustomerDepartment::find($manifest->department_id);
            if($department){
                $row["department"] =$department->department_name;
            }
            else{
                $row["department"] ='';
            }
            $row["date"] = date('d F, Y', strtotime($manifest->created_at));
            $row["actions"] = '<a href="/admin/receiving-manifest/receipt/' . $manifest->id . '">View</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

}
