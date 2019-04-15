<?php

namespace App\Data\Repositories;

use Carbon\Carbon;
use App\Data\Models\Congressman;
use App\Data\Models\CongressmanBudget;
use App\Data\Traits\RepositoryActionable;

class CongressmanBudgets extends Repository
{
    use RepositoryActionable;

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

            $congressmanBudget['sum_debit_formatted'] = to_reais(
                $congressmanBudget['sum_debit']
            );

            $congressmanBudget['sum_credit_formatted'] = to_reais(
                $congressmanBudget['sum_credit']
            );

            $congressmanBudget['balance'] =
                $congressmanBudget['sum_credit'] +
                $congressmanBudget['sum_debit'];

            $congressmanBudget['balance_formatted'] = to_reais(
                $congressmanBudget['balance']
            );

            $congressmanBudget['percentage_formatted'] =
                $congressmanBudget['percentage'] . '%';

            return $congressmanBudget;
        });

        return parent::transform($data);
    }

    public function deposit($modelId)
    {
        $this->findById($modelId)->deposit();
    }

    /**
     * @param $callable
     * @return mixed
     */
    public function withGlobalScopesDisabled($callable)
    {
        Congressman::disableGlobalScopes();

        $result = $callable();

        Congressman::enableGlobalScopes();

        return $result;
    }
}
