<?php

namespace App\Http\Controllers\Production;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Production\Machine;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('production.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
	{
		return view('production.users.add');
	}
	 
    public function postCreate(Request $request)
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
	
	public function getShow(Request $request) {
		$search_filter = '';
		
		if ($request->has('search_string')) {
			$search_filter = " (machine_name like '%$request->search_string%' or machine_number = '$request->search_string') AND ";
		}
			
        //$records = Rule::All();
		$records = array(
				array('user_id' => '35689', 'user_password' => 'welcome1')
		);
		
        $data = array();
        foreach ($records as $key => $record) {
            $row = array();
            $row["user_id"] = $record['user_id'];
            $row["user_password"] = $record['user_password'];
            //$row["actions"] = '<a href="/production/machine/edit/' . $key . '" data-mode="ajax" >Edit</a> / <a href="/production/machine/delete/' . $key . '" data-mode="ajax">Delete</a>';
			
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
