<?php

namespace App\Data\Repositories;

use App\Data\Models\Provider;

class Providers extends Repository
{
    /**
     * @var string
     */
    protected $model = Provider::class;

    public function getAlerj()
    {
        return $this->findByCpfCnpj('30.449.862/0001-67');
    }
}
