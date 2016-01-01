<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Register extends Request
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
			'legal_name' => 'required|max:255',
			'street_address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zipcode' => 'required',
			'fax' => '',
			'country' => 'required',
			'website' => '',
			'phone' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'contact_name' => 'required',
			'contact_designation' => 'required',
			'contact_email' => 'required|email|max:255',
        ];
    }
}
