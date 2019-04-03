<?php

namespace App\Data\Repositories;

use App\Data\Models\CongressmanBudget;

class CongressmanBudgets extends Repository
{
    /**
     * @var string
     */
    protected $model = CongressmanBudget::class;

    public function allFor($congressmanId)
    {
        return $this->applyFilter(
            $this->newQuery()->where('congressman_id', $congressmanId)
        );
    }
}
