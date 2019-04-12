<?php

namespace App\Data\Repositories;

use Carbon\Carbon;
use App\Data\Models\Budget;
use App\Data\Models\Congressman;
use App\Data\Models\CongressmanBudget;
use App\Data\Scopes\Congressman as CongressmanScope;
use App\Data\Scopes\Published as PublishedScope;

class Budgets extends Repository
{
    const FIRST_BUDGET_VALUE = 35759.97;

    const FIRST_BUDGET_PERCENTAGE = 75;

    /**
     * @var string
     */
    protected $model = Budget::class;

    private function generateCongressmanBudget($congressman, $currentGlobal)
    {
        $this->withGlobalScopesDisabled(function () use (
            $congressman,
            $currentGlobal
        ) {
            if (
                $congressman->congressmanBudgets
                    ->where('budget_id', $currentGlobal->id)
                    ->count() > 0
            ) {
                return;
            }

            $current = $congressman->currentBudget;

            CongressmanBudget::create([
                'congressman_legislature_id' =>
                    $congressman->currentLegislature->id,
                'budget_id' => $currentGlobal->id,
                'percentage' => $current->percentage ?? 0,
            ]);
        });
    }

    public function withGlobalScopesDisabled($callable)
    {
        CongressmanScope::disable();
        PublishedScope::disable();

        $callable();

        CongressmanScope::enable();
        PublishedScope::enable();
    }

    private function generateCongressmanBudgets($baseDate = null)
    {
        Congressman::active()
            ->get()
            ->each(function ($congressman) use ($baseDate) {
                $this->generateCongressmanBudget(
                    $congressman,
                    $current = $this->getCurrent($baseDate)
                );
            });
    }

    /**
     *
     */
    private function generateGlobalBudget()
    {
        $current = $this->getCurrent();

        if (
            blank($current) ||
            $current->date->year !== now()->year ||
            $current->date->month !== now()->month
        ) {
            Budget::create([
                'date' => now()->startOfMonth(),
                'federal_value' =>
                    $current->federal_value ?? static::FIRST_BUDGET_VALUE,
                'percentage' =>
                    $current->percentage ?? static::FIRST_BUDGET_PERCENTAGE,
                'created_by_id' => 1,
                'updated_by_id' => 1,
            ]);
        }
    }

    public function getCurrent($baseDate = null)
    {
        $query = $baseDate
            ? $this->newQuery()->where('date', $baseDate)
            : $this->newQuery()->orderBy('date', 'desc');

        return $query->first();
    }

    public function getPrevious($baseDate = null)
    {
        $baseDate = Carbon::parse($baseDate ?? now())->startOfMonth();

        return $this->newQuery()
            ->where('date', '<', $baseDate)
            ->newQuery()
            ->orderBy('date', 'desc')
            ->first();
    }

    public function generate($baseDate = null)
    {
        if ($baseDate) {
            \Carbon\Carbon::setTestNow($baseDate);
        }

        $this->generateGlobalBudget();

        $this->generateCongressmanBudgets($baseDate);
    }

    public function transform($data)
    {
        $this->addTransformationPlugin(function ($budget) {
            $budget['year'] = Carbon::parse($budget['date'])->year;

            $budget['month'] = sprintf(
                '%02d',
                Carbon::parse($budget['date'])->month
            );

            $budget['federal_value_formatted'] = to_reais(
                $budget['federal_value']
            );

            $budget['value_formatted'] = to_reais($budget['value']);

            $budget['percentage_formatted'] = $budget['percentage'] . '%';

            return $budget;
        });

        return parent::transform($data);
    }
}
