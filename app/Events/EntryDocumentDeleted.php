<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;

class EntryDocumentDeleted extends Broadcastable
{
    public $entryId;

    /**
     * Create a new entry instance.
     *
     * @param $entryId
     */
    public function __construct($entryId)
    {
        $this->entryId = $entryId;
    }

    /**
     * Get the channels the entryId should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('entry.' . $this->entryId);
    }
}
