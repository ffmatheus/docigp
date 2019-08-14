<?php

namespace App\Data\Repositories;

use App\Data\Models\EntryType;

class EntryTypes extends Repository
{
    /**
     * @var string
     */
    protected $model = EntryType::class;

    public function getRefundEntryType()
    {
        return $this->findByName('Depósito identificado');
    }
}
