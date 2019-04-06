<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;

class EntryCreated extends Broadcastable
{
    public $entry;

    /**
     * Create a new entry instance.
     *
     * @param $entry
     */
    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    /**
     * Get the channels the entry should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('entry.' . $this->entry->id);
    }
}
