<?php

namespace App\Listeners;

use App\Events\EntriesChanged;
use App\Events\EntryDocumentUpdated;

class OnEntryDocumentUpdated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryDocumentUpdated  $event
     * @return void
     */
    public function handle(EntryDocumentUpdated $event)
    {
        event(new EntriesChanged());
    }
}
