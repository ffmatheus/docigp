<?php

namespace App\Events;

class CongressmanCreated extends Event
{
    public $congressmanId;

    /**
     * Create a new entry Comment instance.
     *
     * @param $entry
     */
    public function __construct($congressmanId)
    {
        $this->congressmanId = $congressmanId;
    }
}
