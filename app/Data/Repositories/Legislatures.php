<?php

namespace App\Data\Repositories;

use App\Data\Models\Legislature as LegislatureModel;

class Legislatures extends Repository
{
    /**
     * @var string
     */
    protected $model = LegislatureModel::class;

    public function getCurrent()
    {
        return $this->newQuery()
            ->orderBy('year_end', 'desc')
            ->first();
    }
}
