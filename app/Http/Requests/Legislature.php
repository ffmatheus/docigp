<?php

namespace App\Http\Requests;

class Legislature extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required|integer',
            'year_start' => 'required|integer|digits:4',
            'year_end' => 'required|integer|digits:4',
        ];
    }
}
