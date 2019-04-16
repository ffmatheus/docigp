<?php

namespace App\Http\Requests;

use App\Services\CpfCnpj\CpfCnpj;

class ProviderStore extends Request
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
            'cpf_cnpj' => ['required', $cpfOrCnpj, 'unique:providers'],
            'name' => 'required',
            'type' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function sanitize(array $all)
    {
        $cpfCnpjFormatter = new CpfCnpj($all['cpf_cnpj']);
        $all['cpf_cnpj'] = $cpfCnpjFormatter->formatAny();
        return parent::sanitize($all);
    }
}
