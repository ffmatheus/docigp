<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

class CongressmanStore extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('people:modify') ||
            Gate::allows('subevents:modify');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zipcode' => 'required',
            'street' => 'required',
            'neighbourhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'number' => 'required',
        ];
    }
}
