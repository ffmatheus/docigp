<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class Event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __call($method, $arguments)
    {
        if (starts_with($method, 'get')) {
            return $this->hasProperty(
                $property = $this->makeProperty('get', $method)
            )
                ? $this->$property
                : null;
        }

        throw new \Exception(
            "Method {$method} does not exists in " . get_class($this)
        );
    }

    protected function hasProperty($param)
    {
        return property_exists($this, $param);
    }

    protected function makeProperty($string, $method)
    {
        return camel_case(substr(snake_case($method), strlen($string)));
    }
}
