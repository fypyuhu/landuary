<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class AddUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_type'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email,NULL,id,organization_id,'.Auth::user()->organization_id,
            'password'=>'required|min:6',
        ];
    }
}
