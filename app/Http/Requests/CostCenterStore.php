<?php

namespace App\Http\Requests;

class CostCenterStore extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required | unique:cost_centers',
            'name' => 'required',
            'frequency' => 'required',
            'limit' => 'required',
            'can_accumulate' => 'required',
        ];
    }
}
