<?php

namespace App\Http\Requests;

class Party extends Request
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
            'name' => 'required'
        ];
    }
}
