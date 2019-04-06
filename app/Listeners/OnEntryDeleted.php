<?php

namespace App\Listeners;

use App\Events\EntryDeleted;
use App\Events\EntriesChanged;

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
        event(new EntriesChanged());
    }
}
