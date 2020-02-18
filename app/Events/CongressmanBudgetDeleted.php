<?php

namespace App\Events;

use App\Data\Models\CongressmanBudget;

class CongressmanBudgetDeleted extends Event
{
    public $congressmanBudgetId;
    public $congressmanId;

    /**
     * Delete a new Congressman Budget instance.
     *
     * @param $entry
     */
    public function __construct($congressmanBudgetId)
    {
        $this->congressmanBudgetId = $congressmanBudgetId;
        $this->congressmanId = //FAZER ISSO!
    }
}
