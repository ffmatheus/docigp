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
        db_listen();

        return $this->applyFilter(
            $this->newQuery()
                ->join(
                    'congressman_legislatures',
                    'congressman_legislatures.id',
                    'congressman_budgets.congressman_legislature_id'
                )
                ->where(
                    'congressman_legislatures.congressman_id',
                    $congressmanId
                )
        );
    }
}
