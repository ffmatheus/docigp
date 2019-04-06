<?php

namespace App\Listeners;

use App\Events\CongressmenChanged;
use App\Events\CongressmanBudgetsChanged;

class NotifyCongressmenChanged extends Listener
{
    /**
     * Handle the event.
     *
     * @param  CongressmanBudgetsChanged  $event
     * @return void
     */
    public function handle(CongressmanBudgetsChanged $event)
    {
        event(new CongressmenChanged());
    }
}
