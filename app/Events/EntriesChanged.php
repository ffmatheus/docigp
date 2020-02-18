<?php

namespace App\Events;

use App\Data\Models\Entry;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Events\Traits\RateLimited;

class EntriesChanged extends Broadcastable
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RateLimited;

    public $congressmanBudgetId;
    public $entryId;

    public function __construct($entryId, $congressmanBudgetId = null)
    {
        $this->entryId = $entryId;

        $this->congressmanBudgetId =
            $congressmanBudgetId ??
            Entry::withoutGlobalScopes()->find($entryId)->congressman_budget_id;
    }

    public function broadcastChannelName()
    {
        return 'congressman_budgets.' . $this->congressmanBudgetId;
    }
}
