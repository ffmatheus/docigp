<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserUpdate extends BaseUser
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'email' => [
                'email',
                Rule::unique('users')->ignore($this->get('id')),
            ],
        ];
    }
}
