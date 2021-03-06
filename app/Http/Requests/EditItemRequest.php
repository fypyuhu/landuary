<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class EditItemRequest extends Request
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
            'item_name' => 'required|unique:items,name,'. $id.',id,organization_id,'.Auth::user()->organization_id,
            'item_number' => 'required|integer|unique:items,item_number,'. $id.',id,organization_id,'.Auth::user()->organization_id,
            'item_desc' => 'required',
            'item_weight' => 'required|numeric',
        ];
    }
}
