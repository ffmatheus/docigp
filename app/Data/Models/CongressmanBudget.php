<?php

namespace App\Data\Models;

use App\Data\Scopes\Published;
use App\Data\Repositories\Budgets;
use App\Data\Traits\MarkAsUnread;
use App\Data\Traits\ModelActionable;
use App\Data\Repositories\CostCenters;
use App\Data\Scopes\Congressman as CongressmanScope;
use App\Support\Constants;

class CongressmanBudget extends Model
{
    use ModelActionable, MarkAsUnread;

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
        'closed_by_id',
        'closed_at',
    ];

    protected $with = ['budget'];

    protected $selectColumns = ['congressman_budgets.*'];

    protected $selectColumnsRaw = [
        '(select count(*) from entries e where e.congressman_budget_id = congressman_budgets.id and e.analysed_at is null) > 0 as has_pendency',
        '(select count(*) from entries e where e.congressman_budget_id = congressman_budgets.id and e.entry_type_id = ' .
            Constants::ENTRY_TYPE_ALERJ_DEPOSIT_ID .
            ') > 0 as has_deposit',
        '(select count(*) from entries e where e.congressman_budget_id = congressman_budgets.id :published-at-filter:) as entries_count',
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

        static::addGlobalScope(new Published());

        static::saved(function (Entry $model) {
            $model->markAsUnread();
        });

        static::created(function (CongressmanBudget $model) {
            $model->updateTransportEntries();
        });
    }

    private function createTransportEntry($balance, $date, $field)
    {
        $this->{$field} = ($entry2 = Entry::updateOrCreate(
            [
                'congressman_budget_id' => $this->id,
                'cost_center_id' => app(CostCenters::class)->findByCode(
                    $balance > 0
                        ? Constants::COST_CENTER_TRANSPORT_CREDIT_ID
                        : Constants::COST_CENTER_TRANSPORT_DEBIT_ID
                )->id,
            ],
            [
                'to' => $this->congressman->name,
                'provider_id' => Constants::ALERJ_PROVIDER_ID,
                'entry_type_id' => Constants::ENTRY_TYPE_TRANSPORT_ID,
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
    }

    /**
     * @return mixed
     */
    private function deleteTransportEntries()
    {
        return Entry::where('congressman_budget_id', $this->id)
            ->whereIn('cost_center_id', [
                Constants::COST_CENTER_TRANSPORT_CREDIT_ID,
                Constants::COST_CENTER_TRANSPORT_DEBIT_ID,
            ])
            ->delete();
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
    private function updateTransportEntry($balance)
    {
        Entry::disableEvents();

        $balance == 0
            ? $this->deleteTransportEntries()
            : $this->createTransportEntry(
                $balance,
                $this->budget->date,
                'transport_' . ($balance > 0 ? 'credit' : 'debit') . '_entry_id'
            );

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
            ->whereNotIn('cost_center_id', [
                Constants::COST_CENTER_TRANSPORT_DEBIT_ID,
            ]) // débito
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
        if ($this->has_deposit) {
            return;
        }

        Entry::create([
            'congressman_budget_id' => $this->id,
            'to' => $this->congressman->name,
            'provider_id' => Constants::ALERJ_PROVIDER_ID,
            'object' => 'Crédito em conta-corrente',
            'cost_center_id' => Constants::COST_CENTER_CREDIT_ID,
            'entry_type_id' => Constants::ENTRY_TYPE_ALERJ_DEPOSIT_ID,
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

    public static function disableGlobalScopes()
    {
        Published::disable();
        CongressmanScope::disable();
    }

    public static function enableGlobalScopes()
    {
        Published::disable();
        CongressmanScope::enable();
    }
}
