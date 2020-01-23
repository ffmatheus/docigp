<?php

namespace App\Listeners;

use App\Events\EntriesChanged;
use App\Events\EntryCreated;

class OnEntryCreated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryCreated  $event
     * @return void
     */
    public function handle(EntryCreated $event)
    {
        event(new EntriesChanged($event->entryId));
    }
}
