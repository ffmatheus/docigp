<?php

namespace App\Events;

class EntryCommentCreated extends Event
{
    public $entryCommentId;
    public $entryId;

    /**
     * Create a new entry Comment instance.
     *
     * @param $entryComment
     */
    public function __construct($entryComment)
    {
        $this->entryCommentId = $entryComment->id;
        $this->entryId = $entryComment->entry_id;
    }
}
