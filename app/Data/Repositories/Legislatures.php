<?php

namespace App\Data\Repositories;

use App\Data\Models\Legislature;

class Legislatures extends Repository
{
    /**
     * @var string
     */
    protected $model = Legislature::class;

    public function getCurrent()
    {
        return $this->newQuery()
            ->orderBy('year_end', 'desc')
            ->first();
    }
}
