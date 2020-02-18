<?php

namespace App\Events;

use App\Data\Models\EntryDocument;

class EntryDocumentCreated extends Event
{
    public $entryDocumentId;
    public $entryId;
    public $congressmanBudgetId;

    /**
     * Create a new entry document instance.
     *
     * @param $entry
     */
    public function __construct($entryDocumentId)
    {
        $entry = EntryDocument::withoutGlobalScopes()->find($entryDocumentId)
            ->entry;
        $this->entryId = $entry->id;
        $this->congressmanBudgetId = $entry->congressmanBudget->id;
        $this->entryDocumentId = $entryDocumentId;
    }
}
