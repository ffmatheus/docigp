<?php

namespace App\Listeners;

use App\Events\EntryUpdated;
use App\Events\CongressmanBudgetsChanged;

class NotifyBudgetsChanged extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryUpdated  $event
     * @return void
     */
    public function handle(EntryUpdated $event)
    {
        event(new CongressmanBudgetsChanged($event->entry->congressmanBudget));
    }
}
