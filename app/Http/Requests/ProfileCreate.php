<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileCreate extends Request
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
            'legal_name' => 'required',
			'street_address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zipcode' => 'required',
			'country' => 'required',
			'phone' => 'required',
			'fax' => 'required',
			'email' => 'required|email',
			'contact_name' => 'required',
			'contact_designation' => 'required',
			'contact_email' => 'required',
        ];
    }
}
