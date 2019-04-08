<?php

namespace App\Http\Requests;

class CostCenter extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required',
            'parent_code' => 'required',
            'name' => 'required',
            'frequency' => 'required',
            'limit' => 'required',
            'can_accumulate' => 'required',
        ];
    }
}
