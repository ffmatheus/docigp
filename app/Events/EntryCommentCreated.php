<?php

namespace App\Events;

class EntryCommentCreated extends Event
{
    public $entryCommentId;

    /**
     * Create a new entry Comment instance.
     *
     * @param $entry
     */
    public function __construct($entryCommentId)
    {
        $this->entryCommentId = $entryCommentId;
    }
}
