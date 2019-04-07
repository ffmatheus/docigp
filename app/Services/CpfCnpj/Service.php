<?php

namespace App\Services\CpfCnpj;

use App\Data\Repositories\Providers;

class Service
{
    public function check($data)
    {
        $cpfCnpj = $data['cpf_cnpj'];

        return [
            'is_valid' => CpfCnpj::check($cpfCnpj),
            'type' => CpfCnpj::type($cpfCnpj),
            'formatted' => CpfCnpj::format($cpfCnpj),
            'unformatted' => CpfCnpj::removeFormat($cpfCnpj),
            'person' => app(Providers::class)->findByCpfCnpj($cpfCnpj),
        ];
    }
}
