<?php

namespace App\Listeners;

use App\Events\CongressmanBudgetUpdated;
use App\Events\CongressmanBudgetsChanged;

class OnCongressmanBudgetUpdated extends Listener
{
    /**
     * Handle the event.
     *
     * @param  CongressmanBudgetUpdated  $event
     * @return void
     */
    public function handle(CongressmanBudgetUpdated $event)
    {
        event(new CongressmanBudgetsChanged($event->congressmanBudgetId));
    }
}
