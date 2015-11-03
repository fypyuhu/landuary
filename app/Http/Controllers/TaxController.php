<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tax;
use App\Models\TaxComponent;
use DB;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('admin.taxes.index');
    }
	
	public function getCreate() 
	{
        return view('admin.taxes.add');
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request) {
		//DD($request);
		$tax = new Tax;
		$tax->tax_name = $request->tax_name;
		$tax->tax_type = $request->tax_type;
		if($request->tax_type == 'single') {
			$tax->agency_name = $request->agency_name;
			$tax->tax_rate = $request->tax_rate;
		}
		$tax->save();
		
		if($request->tax_type == 'combined') {
			$component_name = $request->component_name;
			$component_agency_name = $request->component_agency_name;
			$component_tax_rate = $request->component_tax_rate;
			
			foreach($component_name as $key => $value) {
				$relation = new TaxComponent;
				$relation->tax_id = $tax->id;
				$relation->component_name = $component_name[$key];
				$relation->agency_name = $component_agency_name[$key];
				$relation->tax_rate = $component_tax_rate[$key];
				$relation->save();
			}
		}
    }

    public function getShow(Request $request) {
        $records = DB::table('taxes')->where('is_deleted', '<=', '0')->get();

        $data = array();
        foreach ($records as $record) {
            $row = array();
			$row["tax_type"] = $record->tax_type;
            $row["tax_name"] = $record->tax_name;
            $row["agency_name"] = $record->agency_name;
            $row["tax_rate"] = $record->tax_rate > 0 ? $record->tax_rate : '';
			$row["actions"] = '<a href="/admin/taxes/edit/'.$record->id.'" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/'.$record->id.'" data-mode="ajax">Delete</a>';
            $data[] = $row;
			
			$components = DB::table('taxes')
            ->join('taxes_components', 'taxes.id', '=', 'taxes_components.tax_id')
            ->select('taxes.*', 'taxes_components.*')
			->where('taxes_components.tax_id', '=', $record->id)
			->where('taxes.tax_type', 'combined')
            ->get();
			
            foreach ($components as $component) {
                $sub_row = array();
				$sub_row["tax_type"] = '--';
				$sub_row["tax_name"] = '--';
                $sub_row["component_name"] = '** '.$component->component_name;
                $sub_row["agency_name"] =$component->agency_name;
                $sub_row["tax_rate"] =$component->tax_rate;
                $sub_row["actions"] = '<a href="/admin/taxes/edit/'.$record->id.'" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/'.$record->id.'" data-mode="ajax">Delete</a>';
                $data[] = $sub_row;
            }
        }
		
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id) {
        return view('admin.taxes.edit',['current'=>Tax::find($id)]);
    }
    public function postEdit($id, Request $request) {
        $records = DB::table('taxes')->where('is_deleted', '<=', '0')->get();

        $data = array();
        foreach ($records as $record) {
            $row = array();
			$row["tax_type"] = $record->tax_type;
            $row["tax_name"] = $record->tax_name;
            $row["agency_name"] = $record->agency_name;
            $row["tax_rate"] = $record->tax_rate > 0 ? $record->tax_rate : '';
			$row["actions"] = '<a href="/admin/taxes/edit/'.$record->id.'" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/'.$record->id.'" data-mode="ajax">Delete</a>';
            $data[] = $row;
			
			$components = DB::table('taxes')
            ->join('taxes_components', 'taxes.id', '=', 'taxes_components.tax_id')
            ->select('taxes.*', 'taxes_components.*')
			->where('taxes_components.tax_id', '=', $record->id)
			->where('taxes.tax_type', 'combined')
            ->get();
			
            foreach ($components as $component) {
                $sub_row = array();
				$sub_row["tax_type"] = '--';
				$sub_row["tax_name"] = '--';
                $sub_row["component_name"] = '** '.$component->component_name;
                $sub_row["agency_name"] =$component->agency_name;
                $sub_row["tax_rate"] =$component->tax_rate;
                $sub_row["actions"] = '<a href="/admin/taxes/edit/'.$record->id.'" data-mode="ajax" >Edit</a> / <a href="/admin/taxes/delete/'.$record->id.'" data-mode="ajax">Delete</a>';
                $data[] = $sub_row;
            }
        }
		
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id) {
        return view('admin.taxes.delete',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id, Request $request) {
        $tax = Tax::find($id);
        $tax->is_deleted=1;
        $tax->save();
    }
}
