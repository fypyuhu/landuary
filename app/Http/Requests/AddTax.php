<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class AddTax extends Request
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
            'tax_name' => 'required|unique:taxes,tax_name,NULL,id,organization_id,'.Auth::user()->organization_id,
        ];
    }
}
