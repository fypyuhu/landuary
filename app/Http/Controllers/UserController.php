<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Auth;
use App\Models\UserProfile;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        return view('admin.profile.users.index');
    }

    public function getCreate() {
        return view('admin.profile.users.add');
    }

    public function postCreate(AddUserRequest $request) {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->organization_id = Auth::user()->organization_id;
        $user->role_id = $request->user_type;
        $user->visited = 1;
        $user->save();
        $user_profile = new UserProfile;
        $user_profile->user_id = $user->id;
        $user_profile->save();
    }

    public function getShow(Request $request) {
        if ($request->has('search_string')) {
            $users = User::Organization()->NonAdmin()->with('role')->where(function ($query) use ($request){
            $query->whereRaw("first_name like '%$request->search_string%'")
                    ->orWhereRaw("last_name like '%$request->search_string%'");
            })->get();
        }
        else{
            $users = User::Organization()->NonAdmin()->with('role')->get();
        }
        $data = array();
        foreach ($users as $user) {
            $row = array();
            $row['role_name'] = $user->role->name;
            $row['first_name'] = $user->first_name;
            $row['last_name'] = $user->last_name;
            $row['email'] = $user->email;
            $row['actions'] = '<a href="/admin/users/edit/' . $user->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/users/delete/' . $user->id . '" data-mode="ajax">Delete</a>';
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
    public function getEdit($id) {
        $user = User::find($id);
        return view('admin.profile.users.edit',["user"=>$user]);
    }
    public function postEdit($id) {
        $user = User::find($id);
    }
    public function getDelete($id) {
        //
    }
    public function postDelete($id) {
        //
    }

}
