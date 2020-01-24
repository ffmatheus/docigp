<?php

namespace App\Events;

use App\Data\Models\Entry;

class EntryDocumentDeleted extends Event
{
    public $entryDocumentId;
    public $entryId;
    public $congressmanBudgetId;

    /**
     * Create a new entry document instance.
     *
     * @param $entryDocument
     */
    public function __construct($entryDocument)
    {
        $entryDocument = (object)$entryDocument->toArray();

        $this->entryDocumentId = $entryDocument->id;

        $entry = Entry::find($entryDocument->entry_id);
        $this->entryId = $entry->id;

        $this->congressmanBudgetId = $entry->congressman_budget_id;
    }
}
