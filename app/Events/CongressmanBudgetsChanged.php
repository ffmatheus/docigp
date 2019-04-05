<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CongressmanBudgetsChanged extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $congressmanBudget;

    /**
     * Create a new event instance.
     *
     * @param $congressmanBudget
     */
    public function __construct($congressmanBudget)
    {
        $this->congressmanBudget = $congressmanBudget;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('congressman_budgets');
    }
}
