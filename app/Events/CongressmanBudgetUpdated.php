<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Events\Traits\RateLimited;

class CongressmanBudgetUpdated extends Broadcastable
{
    use RateLimited;

    protected $congressmanBudgetId;

    /**
     * Create a new congressmanBudget instance.
     *
     * @param $congressmanBudget
     */
    public function __construct($congressmanBudgetId)
    {
        $this->congressmanBudgetId = $congressmanBudgetId;
    }

    /**
     * Get the channels the congressmanBudget should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        info(
            class_basename($this) .
                ' => congressmanBudget.' .
                $this->congressmanBudgetId
        );
        return new Channel('congressmanBudget.' . $this->congressmanBudgetId);
    }
}
