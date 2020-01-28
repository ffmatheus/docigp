<?php

namespace App\Listeners;

use App\Events\EntryCommentDeleted;
use App\Events\EntryCommentsChanged;

class OnEntryCommentDeleted extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryCommentDeleted  $event
     * @return void
     */
    public function handle(EntryCommentDeleted $event)
    {
        event(new EntryCommentsChanged($event->entryId));
    }
}
