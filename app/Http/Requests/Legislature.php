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
            'number' => 'required',
            'year_start' => 'required',
            'year_end' => 'required',
        ];
    }
}
