<?php

namespace App\Http\Requests;

class BaseUser extends Request
{
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
