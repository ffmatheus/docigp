<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use App\Rules\ValidCPF;
use App\Rules\ValidCNPJ;

class ProviderUpdate extends ProviderStore
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $cpfOrCnpj =
            $this->get('type') == 'PF' ? new ValidCPF() : new ValidCNPJ();
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
