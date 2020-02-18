<?php

namespace App\Events;

use App\Data\Models\CongressmanBudget;
use App\Data\Models\Entry;

class EntryDocumentDeleted extends Event
{
    public $entryDocumentId;
    public $entryId;
    public $congressmanBudgetId;
    public $congressmanId;

    /**
     * Create a new entry document instance.
     *
     * @param $entry
     */
    public function __construct($entryDocument)
    {
        $this->entryDocumentId = $entryDocument->id;
        $this->entryId = $entryDocument->entry_id;
        $entry = Entry::withoutGlobalScopes()->find($this->entryId);
        $congressmanBudget = CongressmanBudget::withoutGlobalScopes()->find(
            $entry->congressman_budget_id
        );
        $this->congressmanBudgetId = $congressmanBudget->id;
        $this->congressmanId = $congressmanBudget->congressman->id;
    }
}
