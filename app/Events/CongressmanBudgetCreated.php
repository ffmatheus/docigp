<?php

namespace App\Events;

use App\Data\Models\CongressmanBudget;

class CongressmanBudgetCreated extends Event
{
    public $congressmanBudgetId;
    public $congressmanId;

    /**
     * Create a new entry Comment instance.
     *
     * @param $entry
     */
    public function __construct($congressmanBudgetId)
    {
        $this->congressmanBudgetId = $congressmanBudgetId;
        $this->congressmanId = CongressmanBudget::withoutGlobalScopes()->find(
            $congressmanBudgetId
        );
    }
}
