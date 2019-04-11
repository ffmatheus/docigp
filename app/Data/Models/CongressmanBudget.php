<?php

namespace App\Data\Models;

use App\Data\Repositories\Budgets;
use App\Data\Repositories\CostCenters;
use App\Data\Traits\ModelActionable;

class CongressmanBudget extends Model
{
    use ModelActionable;

    /**
     * @var array
     */
    protected $fillable = [
        'congressman_legislature_id',
        'budget_id',
        'percentage',
        'analysed_by_id',
        'analysed_at',
        'published_by_id',
        'published_at',
    ];

    protected $with = ['budget'];

    protected $selectColumns = ['congressman_budgets.*'];

    protected $selectColumnsRaw = [
        '(select count(*) from entries e where e.congressman_budget_id = congressman_budgets.id and e.analysed_at is null) > 0 as has_pendency',
        '(select count(*) from entries e where e.congressman_budget_id = congressman_budgets.id) as entries_count',
        '(select sum(value) from entries e where e.congressman_budget_id = congressman_budgets.id and value > 0) as sum_credit',
        '(select sum(value) from entries e where e.congressman_budget_id = congressman_budgets.id and value < 0) as sum_debit',
    ];

    protected $orderBy = ['budgets.date' => 'desc'];

    protected $joins = [
        'budgets' => ['budgets.id', '=', 'congressman_budgets.budget_id'],
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function (CongressmanBudget $model) {
            $model->updateTransportEntries();
        });
    }

    protected function fillValue(): void
    {
        if ($this->percentageChanged()) {
            $budget = app(Budgets::class)->findById($this->budget_id);

            $this->value = ($budget->value * $this->percentage) / 100;
        }
    }

    /**
     * @param $balance
     */
    private function updateTransportEntry($balance): void
    {
        $date = $this->budget->date;

        $field =
            'transport_' . ($balance > 0 ? 'credit' : 'debit') . '_entry_id';

        Entry::disableEvents();

        $this->{$field} = ($entry2 = Entry::updateOrCreate(
            [
                'congressman_budget_id' => $this->id,
                'cost_center_id' => app(CostCenters::class)->findByCode(
                    $balance > 0 ? '3' : '2'
                )->id,
            ],
            [
                'to' => $this->congressman->name,
                'provider_id' => 1, // Alerj
                'entry_type_id' => 1, // Transferência
                'object' =>
                    'Transporte de saldo ' .
                    ($balance > 0
                        ? 'do período anterior'
                        : 'para o próximo período'),
                'date' =>
                    $balance > 0 ? $date->startOfMonth() : $date->endOfMonth(),
                'value' => $balance,
            ]
        ))->id;

        $this->save();

        Entry::enableEvents();
    }

    protected function percentageChanged()
    {
        return blank($this->value) ||
            ($this->isDirty('percentage') && !$this->isDirty('value'));
    }

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->fillValue();

        return parent::save();
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function getBalance()
    {
        return $this->entries()
            ->selectRaw('sum(value) as balance')
            ->first()->balance ?? 0;
    }

    public function getBalanceWithoutDebitTransport()
    {
        return $this->entries()
            ->selectRaw('sum(value) as balance')
            ->whereNotIn('cost_center_id', [2]) // débito
            ->first()->balance ?? 0;
    }

    public function congressmanLegislature()
    {
        return $this->belongsTo(CongressmanLegislature::class);
    }

    public function congressman()
    {
        return $this->congressmanLegislature->congressman();
    }

    public function deposit()
    {
        if ($this->entries_count > 0) {
            return;
        }

        Entry::create([
            'congressman_budget_id' => $this->id,
            'to' => $this->congressman->name,
            'provider_id' => 1, // Alerj
            'object' => 'Crédito em conta-corrente',
            'cost_center_id' => 1, // Depósito
            'date' => now(),
            'value' => $this->value,
        ]);
    }

    public function updateTransportEntries()
    {
        if ($next = $this->congressman->getNextBudgetRelativeTo($this)) {
            $value = $this->getBalanceWithoutDebitTransport();

            $next->updateTransportEntry(
                $balance = abs($value = $value < 0 ? 0 : $value)
            );

            $this->updateTransportEntry($balance * -1);
        }
    }
}
