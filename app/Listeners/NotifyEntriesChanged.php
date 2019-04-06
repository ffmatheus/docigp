<?php

namespace App\Listeners;

use App\Events\EntriesChanged;
use App\Events\EntryUpdated;
use App\Events\CongressmanBudgetsChanged;

class NotifyEntriesChanged extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryUpdated  $event
     * @return void
     */
    public function handle(EntriesChanged $event)
    {
        event(new CongressmanBudgetsChanged($event->entry->congressmanBudget));
    }
}
