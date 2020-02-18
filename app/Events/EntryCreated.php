<?php

namespace App\Events;

use App\Data\Models\Entry;

class EntryCreated extends Event
{
    public $entryId;
    public $congressmanBudgetId;
    public $congressmanId;

    /**
     * Create a new entry instance.
     *
     * @param $entry
     */
    public function __construct($entryId)
    {
        $entry = Entry::withoutGlobalScopes()->find($entryId);
        $this->entryId = $entry->id;
        $this->congressmanBudgetId = $entry->congressmanBudget->id;
        $this->congressmanId = $entry->congressmanBudget->congressman->id;
    }
}
