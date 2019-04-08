<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;

class CongressmanUpdated extends Broadcastable
{
    public $congressman;

    /**
     * Create a new congressman instance.
     *
     * @param $congressman
     */
    public function __construct($congressman)
    {
        $this->congressman = $congressman;
    }

    /**
     * Get the channels the congressman should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('congressman.' . $this->congressman->id);
    }
}
