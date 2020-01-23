<?php

namespace App\Listeners;

use App\Events\EntryDocumentsChanged;
use App\Events\EntryDocumentCreated;

class OnEntryDocumentCreated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryDocumentCreated  $event
     * @return void
     */
    public function handle(EntryDocumentCreated $event)
    {
        event(new EntryDocumentsChanged($event->entryDocumentId));
    }
}
