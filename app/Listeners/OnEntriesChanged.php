<?php

namespace App\Listeners;

use App\Events\CongressmanBudgetsChanged;

class OnEntriesChanged extends Listener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        event(new CongressmanBudgetsChanged());
    }
}
