<?php

namespace App\Data\Repositories;

use Carbon\Carbon;
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

    public function transform($data)
    {
        $this->addTransformationPlugin(function ($congressmanBudget) {
            $congressmanBudget['year'] = Carbon::parse(
                $congressmanBudget['budget']['date']
            )->year;

            $congressmanBudget['month'] = sprintf(
                '%02d',
                Carbon::parse($congressmanBudget['budget']['date'])->month
            );

            $congressmanBudget['state_value_formatted'] = to_reais(
                $congressmanBudget['budget']['value']
            );

            $congressmanBudget['value_formatted'] = to_reais(
                $congressmanBudget['value']
            );

            $congressmanBudget['percentage_formatted'] =
                $congressmanBudget['percentage'] . '%';

            return $congressmanBudget;
        });

        return parent::transform($data);
    }
}
