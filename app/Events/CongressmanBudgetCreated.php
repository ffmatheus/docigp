<?php

namespace App\Events;

class CongressmanBudgetCreated extends Event
{
    public $congressmanBudgetId;

    /**
     * Create a new entry Comment instance.
     *
     * @param $entry
     */
    public function __construct($congressmanBudgetId)
    {
        $this->congressmanBudgetId = $congressmanBudgetId;
    }
}
