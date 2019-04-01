<?php

namespace App\Data\Repositories;

use App\Data\Models\Budget;
use App\Data\Models\Congressman;
use App\Data\Models\CongressmanBudget;

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
        if (
            $congressman->budgets
                ->where('date', $currentGlobal->date)
                ->count() > 0
        ) {
            return;
        }

        $current = $congressman->currentBudget;

        CongressmanBudget::create([
            'congressman_id' => $congressman->id,
            'budget_id' => $currentGlobal->id,
            'percentage' => $current->percentage ?? 0,
        ]);
    }

    private function generateCongressmanBudgets()
    {
        Congressman::active()
            ->get()
            ->each(function ($congressman) {
                $this->generateCongressmanBudget(
                    $congressman,
                    $this->getCurrent()
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

    public function getCurrent()
    {
        return $this->newQuery()
            ->orderBy('date', 'desc')
            ->first();
    }

    public function generate()
    {
        $this->generateGlobalBudget();

        $this->generateCongressmanBudgets();
    }
}
