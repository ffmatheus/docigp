<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;

class CongressmanBudgetUpdated extends Broadcastable
{
    protected $congressmanBudget;

    /**
     * Create a new congressmanBudget instance.
     *
     * @param $congressmanBudget
     */
    public function __construct($congressmanBudget)
    {
        $this->congressmanBudget = $congressmanBudget;
    }

    /**
     * Get the channels the congressmanBudget should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('congressmanBudget.' . $this->congressmanBudget->id);
    }
}
