<?php

namespace App\Listeners;

use App\Events\EntriesChanged;
use App\Events\CongressmanBudgetsChanged;

class OnEntriesChanged extends Listener
{
    /**
     * Handle the event.
     *
     * @param \App\Events\EntriesChanged $event
     * @return void
     */
    public function handle(EntriesChanged $event)
    {
        event(new CongressmanBudgetsChanged());
    }
}
