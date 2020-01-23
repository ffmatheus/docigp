<?php

namespace App\Events;

class EntryCreated extends Event
{
    public $entryId;

    /**
     * Create a new entry instance.
     *
     * @param $entry
     */
    public function __construct($entryId)
    {
        $this->entryId = $entryId;
    }
}
