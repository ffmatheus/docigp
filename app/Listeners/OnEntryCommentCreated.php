<?php

namespace App\Listeners;

use App\Events\EntryCommentsChanged;
use App\Events\EntryCommentCreated;

class OnEntryCommentCreated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  EntryCommentCreated  $event
     * @return void
     */
    public function handle(EntryCommentCreated $event)
    {
        event(new EntryCommentsChanged($event->entryCommentId));
    }
}
