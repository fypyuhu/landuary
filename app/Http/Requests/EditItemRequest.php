<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

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
            'item_name' => 'required',
            'item_number' => 'required|integer|unique:items,item_number,'. $id,
            'item_desc' => 'required',
            'item_weight' => 'required|numeric',
        ];
    }
}
