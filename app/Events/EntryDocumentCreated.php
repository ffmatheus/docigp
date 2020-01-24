<?php

namespace App\Events;

class EntryDocumentCreated extends Event
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
        $this->entryDocumentId = $entryDocument->id;
        $this->entryId = $entryDocument->entry_id;
        $this->congressmanBudgetId = $entryDocument->entry->congressman_budget_id;
    }
}
