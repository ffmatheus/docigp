<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Events\Traits\RateLimited;

class EntryCreated extends Broadcastable
{
    use RateLimited;

    public $entryId;
    public $congressmanBudgetId;

    /**
     * Create a new entry instance.
     *
     * @param $entry
     */
    public function __construct($entryId)
    {
        $this->entryId = $entryId;
    }

    /**
     * Get the channels the entry should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        info(class_basename($this) . ' => entry.' . $this->entryId);
        return new Channel('entry.' . $this->entryId);
    }
}
