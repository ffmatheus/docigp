<?php

namespace App\Http\Requests;

class Congressman extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['email' => 'required|email|exists:users,email'];
    }

    public function messages()
    {
        return ['email.exists' =>'Email não encontrado no cadastro de usuários'];
    }
}
