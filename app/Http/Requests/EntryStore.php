<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Gate::allows('entries:store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required',
            'value' => 'required',
            'object' => 'required',
            'provider_id' => 'required',
            'cost_center_id' => 'required',
        ];
    }
}
