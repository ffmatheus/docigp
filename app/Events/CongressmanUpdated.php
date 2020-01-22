<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Events\Traits\RateLimited;

class CongressmanUpdated extends Broadcastable
{
    use RateLimited;

    public $congressmanId;

    /**
     * Create a new congressman instance.
     *
     * @param $congressmanId
     */
    public function __construct($congressmanId)
    {
        $this->congressmanId = $congressmanId;
    }

    /**
     * Get the channels the congressman should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        info(class_basename($this) . ' => entry.' . $this->congressmanId);
        return new Channel('congressman.' . $this->congressmanId);
    }
}
