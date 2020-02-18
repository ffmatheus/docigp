<?php

namespace App\Listeners;

use App\Data\Models\CongressmanBudget;
use App\Events\CongressmanBudgetsChanged;
use App\Events\EntriesChanged;
use App\Events\EntryDeleted;

class OnEntryDeleted extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryDeleted  $event
     * @return void
     */
    public function handle(EntryDeleted $event)
    {
        event(new EntriesChanged($event->entryId, $event->congressmanBudgetId));
        event(
            new CongressmanBudgetsChanged(
                $event->congressmanBudgetId,
                $event->congressmanId
            )
        );
    }
}
