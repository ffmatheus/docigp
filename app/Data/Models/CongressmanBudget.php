<?php

namespace App\Data\Models;

use App\Data\Repositories\Budgets;

class CongressmanBudget extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'congressman_legislature_id',
        'budget_id',
        'percentage',
        'approved_by_id',
        'approved_at',
        'published_by_id',
        'published_at',
    ];

    protected $with = ['budget'];

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
