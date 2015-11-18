<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReceivingManifest;
use App\Models\ShipManifest;
use App\Models\Customer;

class ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
	return view('admin.manifests.index');
    }
    public function getShowShipping()
    {
        $ship_manifests = ShipManifest::with('customer')->get();
        $data = array();
        foreach ($ship_manifests as $manifest) {
            $row = array();
            $row["id"] = $manifest->id;
            $row["name"] = $manifest->customer->name;
            $row["date"] = $manifest->shipping_date;
            $row["actions"] = '<a href="/admin/shiping-manifest/recipt/'.$manifest->id.'">View</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }
     public function getShowReceiving()
    {
        $receiving_manifests = ReceivingManifest::with('customer')->get();
        $data = array();
        foreach ($receiving_manifests as $manifest) {
            $row = array();
            $row["id"] = $manifest->id;
            $row["name"] = $manifest->customer->name;
            $row["date"] = $manifest->created_at;
            $row["actions"] = '<a href="/admin/receiving-manifest/receipt/'.$manifest->id.'">View</a>';
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
