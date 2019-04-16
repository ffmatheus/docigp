<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserUpdate extends Request
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

    /**
     * @return array
     */
    public function sanitize(array $all)
    {
        if (!is_array($all['roles_array'])) {
            $all['roles_array'] = json_decode($all['roles_array'], true);
        }
        return parent::sanitize($all);
    }
}
