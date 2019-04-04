<?php

namespace App\Listeners;

use App\Events\EntryUpdated;

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
        //
    }
}
