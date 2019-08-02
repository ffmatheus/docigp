<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;

class EntryCreated extends Broadcastable
{
    public $entryId;
    public $congressmanBudgetId;

    /**
     * Create a new entry instance.
     *
     * @param $entry
     */
    public function __construct($entry)
    {
        $this->entryId = $entry->id;
        $this->congressmanBudgetId = $entry->congressmanBudget->id;
    }

    /**
     * Get the channels the entry should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('entry.' . $this->entryId);
    }
}
