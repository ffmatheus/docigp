<?php

namespace App\Http\Requests;

class BaseUser extends Request
{
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
