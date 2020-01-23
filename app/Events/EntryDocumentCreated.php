<?php

namespace App\Events;

class EntryDocumentCreated extends Event
{
    public $entryDocumentId;

    /**
     * Create a new entry document instance.
     *
     * @param $entry
     */
    public function __construct($entryDocumentId)
    {
        $this->entryDocumentId = $entryDocumentId;
    }
}
