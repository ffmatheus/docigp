<?php

namespace App\Listeners;

use App\Events\CongressmanBudgetsChanged;
use App\Events\CongressmanBudgetCreated;

class OnCongressmanBudgetCreated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  CongressmanBudgetCreated  $event
     * @return void
     */
    public function handle(CongressmanBudgetCreated $event)
    {
        event(new CongressmanBudgetsChanged($event->congressmanId));
    }
}
