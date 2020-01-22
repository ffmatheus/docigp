<?php

namespace App\Listeners;

use App\Data\Repositories\Entries;
use App\Data\Repositories\CongressmanBudgets;
use App\Events\EntryUpdated;
use App\Events\CongressmanBudgetsChanged;

class OnEntryUpdated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryUpdated  $event
     * @return void
     */
    public function handle(EntryUpdated $event)
    {
        if (
            $congressmanBudget = app(CongressmanBudgets::class)->findById(
                $event->congressmanBudgetId
            )
        ) {
            event(new CongressmanBudgetsChanged());
        }
    }
}
