<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Queue\ShouldQueue;

class OnUserCreated implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param UserCreated $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $event->user->sendWelcomeMessage();

        Password::sendResetLink(['email' => $event->user->email]);
    }
}
