<?php

namespace App\Data\Models;

class CongressmanBudget extends Model
{
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
}
