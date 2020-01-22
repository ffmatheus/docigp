<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Events\Traits\RateLimited;

class CongressmenChanged extends Broadcastable
{
    use RateLimited;
    /**
     * Get the channels the congressman should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('congressmen');
    }
}
