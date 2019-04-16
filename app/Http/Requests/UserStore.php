<?php

namespace App\Http\Requests;

class UserStore extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:users'],
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
