<?php

namespace App\Http\Requests;

class User extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'email' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function sanitize()
    {
        $input = $this->all();
        $input['roles_array'] = json_decode($input['roles_array'], true);
        $this->replace($input);
        return $this->all();
    }
}
