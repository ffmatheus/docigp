<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProviderUpdate extends ProviderStore
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $cpfOrCnpj = $this->get('type') == 'PF' ? 'cpf' : 'cnpj';
        return [
            'cpf_cnpj' => [
                'required',
                $cpfOrCnpj,
                Rule::unique('providers')->ignore($this->get('id')),
            ],
            'name' => 'required',
            'type' => 'required',
        ];
    }
}
