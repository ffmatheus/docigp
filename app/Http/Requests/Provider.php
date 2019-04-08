<?php

namespace App\Http\Requests;

class Provider extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf_cnpj' => 'required', //cpf_cnpj //TODO adicionar o plugin.
            'name' => 'required',
            'type' => 'required',
        ];
    }
}
