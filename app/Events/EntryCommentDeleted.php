<?php

namespace App\Events;

use App\Data\Models\CongressmanBudget;
use App\Data\Models\Entry;

class EntryCommentDeleted extends Event
{
    public $entryCommentId;
    public $entryId;
    public $congressmanBudgetId;
    public $congressmanId;

    /**
     * Create a new entry Comment instance.
     *
     * @param $entry
     */
    public function __construct($entryComment)
    {
        $this->entryCommentId = $entryComment->id;
        $this->entryId = $entryComment->entry_id;
        $entry = Entry::withoutGlobalScopes()->find($this->entryId);
        $congressmanBudget = CongressmanBudget::withoutGlobalScopes()->find(
            $entry->congressman_budget_id
        );
        $this->congressmanBudgetId = $congressmanBudget->id;
        $this->congressmanId = $congressmanBudget->congressman->id;
    }
}
