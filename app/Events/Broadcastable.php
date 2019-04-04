<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class Broadcastable extends Event implements ShouldBroadcast
{
}
