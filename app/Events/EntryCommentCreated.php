<?php

namespace App\Events;

use App\Data\Models\EntryComment;

class EntryCommentCreated extends Event
{
    public $entryCommentId;
    public $entryId;
    public $congressmanBudgetId;

    /**
     * Create a new entry Comment instance.
     *
     * @param $entry
     */
    public function __construct($entryCommentId)
    {
        $entry = EntryComment::withoutGlobalScopes()->find($entryCommentId)
            ->entry;
        $this->entryId = $entry->id;
        $this->congressmanBudgetId = $entry->congressmanBudget->id;
        $this->entryCommentId = $entryCommentId;
    }
}
