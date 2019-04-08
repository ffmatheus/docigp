<?php

namespace App\Data\Models;

use App\Data\Repositories\Budgets;
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
        'complied_by_id',
        'complied_at',
        'published_by_id',
        'published_at',
    ];

    protected $with = ['budget'];

    protected $selectColumns = ['congressman_budgets.*'];

    protected $selectColumnsRaw = [
        '(select count(*) from entries e where e.congressman_budget_id = congressman_budgets.id and e.complied_at is null) > 0 as has_pendency',
        '(select count(*) from entries e where e.congressman_budget_id = congressman_budgets.id) as entries_count',
    ];

    protected $orderBy = ['budgets.date' => 'desc'];

    protected $joins = [
        'budgets' => ['budgets.id', '=', 'congressman_budgets.budget_id'],
    ];

    protected function fillValue(): void
    {
        if ($this->percentageChanged()) {
            $budget = app(Budgets::class)->findById($this->budget_id);

            $this->value = ($budget->value * $this->percentage) / 100;
        }
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

    public function budget()
    {
        return $this->belongsTo(Budget::class);
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

        info($this->congressman);

        info(
            Entry::create([
                'congressman_budget_id' => $this->id,
                'to' => $this->congressman->name,
                'object' => 'Crédito em conta-corrente',
                'cost_center_id' => 1,
                'date' => now(),
                'value' => $this->value,
            ])
        );
    }
}
