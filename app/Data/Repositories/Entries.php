<?php

namespace App\Data\Repositories;

use Carbon\Carbon;
use App\Data\Models\Entry;
use App\Data\Traits\RepositoryActionable;
use Illuminate\Support\Str;

class Entries extends Repository
{
    use RepositoryActionable;

    /**
     * @var string
     */
    protected $model = Entry::class;

    public function allFor($congressmanId, $congressmanBudgetId)
    {
        return $this->applyFilter(
            $this->newQuery()
                ->join(
                    'congressman_budgets',
                    'congressman_budgets.id',
                    'entries.congressman_budget_id'
                )
                ->join(
                    'congressman_legislatures',
                    'congressman_legislatures.id',
                    'congressman_budgets.congressman_legislature_id'
                )
                ->where(
                    'congressman_legislatures.congressman_id',
                    $congressmanId
                )
                ->where('congressman_budgets.id', $congressmanBudgetId)
        );
    }

    public function transform($data)
    {
        $this->addTransformationPlugin(function ($entry) {
            $entry['date_formatted'] = Carbon::parse($entry['date'])->format(
                'd/m/Y'
            );

            $entry['date'] = $entry['date_formatted'];

            $entry['value_formatted'] = to_reais($entry['value']);

            $entry['value_abs'] = abs($entry['value']);

            $entry['cost_center_name_formatted'] = Str::limit(
                $entry['cost_center_name'],
                60,
                '...'
            );

            return $entry;
        });

        return parent::transform($data);
    }
}
