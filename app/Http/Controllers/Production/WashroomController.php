<?php

namespace App\Http\Controllers\Production;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Production\Machine;

class WashroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('production.washroom.report', ['link' => 0]);
    }
	
	public function getMachine()
    {
        return view('production.washroom.machine.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function getMachineCreate()
	{
		return view('production.washroom.machine.add');
	}
	 
    public function postMachineCreate(Request $request)
    {
        $create = new Machine;
		$create->machine_name = $request->machine_name;
		$create->machine_number = $request->machine_number;
		$create->machine_description = $request->machine_description;
		$create->machine_capacity = $request->machine_capacity;
		
		if ($request->hasFile('machine_image') && $request->file('machine_image')->isValid()) {
            $fileName = time() . $request->file('machine_image')->getClientOriginalName(); // getting image extension
            $destinationPath = public_path() . "/uploads/machines";
            $request->file('machine_image')->move($destinationPath, $fileName);
            $create->machine_image = $fileName;
        }
		
		$create->save();
    }
	
	public function getStartMachine() {
		return view('production.washroom.machine.start');
	}
	
	public function getMachineDetail() {
		return view('production.washroom.machine.machineDetail');
	}
	
	public function getReport() {
		return view('production.washroom.report', ['link' => 0]);
	}
	
	public function postSearch(Request $request) {
		$machine = $request->machine;
		return view('production.washroom.report', [ 'machine' => $machine, 'link' => 0 ]);
	}
	
	public function getSearchLink() {
		return view('production.washroom.report', [ 'link' => 1 ]);
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
    public function show($id)
    {
        //
    }
	
	public function getMachineShow(Request $request)
    {
        $search_filter = '';
		
		if ($request->has('search_string')) {
			$search_filter = " (machine_name like '%$request->search_string%' or machine_number = '$request->search_string') AND ";
		}
			
        $records = Washroom::All();
        $data = array();
        foreach ($records as $record) {
            $row = array();
            $row["machine_name"] = $record->machine_name;
            $row["machine_number"] = $record->machine_number;
			$row["machine_description"] = $record->machine_description;
            $row["machine_capacity"] = $record->machine_capacity;
            $row["machine_image"] = $record->machine_image;
            $row["actions"] = '<a href="/production/machine/edit/' . $record->id . '" data-mode="ajax" >Edit</a> / <a href="/production/machine/delete/' . $record->id . '" data-mode="ajax">Delete</a>';
			
			$data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function getMachineEdit($id) {
		return view('production.washroom.machine.edit');
	}
	
    public function postEdit($id)
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
	 
	public function getMachineDelete($id) {
        return view('production.washroom.machine.delete', ['id' => $id]);
    }
	
    public function postMachineDelete($id)
    {
        $rec = Washroom::find($id);
        $rec->delete();
    }
}
