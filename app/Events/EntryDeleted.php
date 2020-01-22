<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Events\Traits\RateLimited;

class EntryDeleted extends Broadcastable
{
    use RateLimited;

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
        info(class_basename($this) . ' => entry.' . $this->entryId);
        return new Channel('entry.' . $this->entryId);
    }
}
