<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;

class EntryUpdated extends Broadcastable
{
    protected $entry;

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
