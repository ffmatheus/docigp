<?php

namespace App\Events;

use App\Data\Models\CongressmanBudget;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\Traits\RateLimited;

class CongressmanBudgetsChanged extends Broadcastable
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RateLimited;

    public $congressmanBudgetId;
    public $congressmanId;

    /**
     * Create a new congressmanBudget instance.
     *
     * @param $congressmanBudget
     */
    public function __construct($congressmanBudgetId, $congressmanId = null)
    {
        $this->congressmanBudgetId = $congressmanBudgetId;

        $this->congressmanId =
            $congressmanId ??
            CongressmanBudget::withoutGlobalScopes()->find($congressmanBudgetId)
                ->congressman->id;
    }

    public function broadcastChannelName()
    {
        return 'congressmen.' . $this->congressmanId;
    }
}
