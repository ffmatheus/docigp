<?php

namespace App\Http\Requests;

use App\Rules\EmailExists;
use App\Services\Authentication\Service as AuthenticationService;

class UserStore extends BaseUser
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
}
