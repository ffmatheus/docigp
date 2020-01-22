<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Events\Traits\RateLimited;

class EntryDocumentUpdated extends Broadcastable
{
    use RateLimited;

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
        info(class_basename($this) . ' => entry.' . $this->entry);
        return new Channel('entry.' . $this->entry->id);
    }
}
