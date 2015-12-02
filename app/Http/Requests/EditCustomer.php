<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class EditCustomer extends Request
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
        $id = $this->route('one');
        return [
            'customer_number' => 'required|integer|unique:customers,customer_number,'. $id.',id,organization_id,'.Auth::user()->organization_id,
        ];
    }
}
