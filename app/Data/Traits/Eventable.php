<?php

namespace App\Data\Traits;

use ReflectionClass;
use Illuminate\Support\Str;

trait Eventable
{
    /**
     * @param $model
     * @param string $type
     */
    protected function fireEvents($model, $type = null)
    {
        $type = $this->inferEventType($model, $type);

        $this->fireEventForModel($model, $type);

        $this->fireEventForTable($model, 'Changed', true);

        if (method_exists($this, 'fireEventsForRelationships')) {
            $this->fireEventsForRelationships($model, $type);
        }
    }

    protected function fireEventForModel($model, $eventType)
    {
        $reflect = new ReflectionClass($model);

        $className = $reflect->getShortName();

        $eventClass = "App\\Events\\{$className}{$eventType}";

        if (class_exists($eventClass)) {
            event(new $eventClass($model));
        }
    }

    protected function fireEventForTable($model, $eventType, $plural = false)
    {
        $tableName = Str::studly($model->getTable());

        $tableName = $plural ? Str::plural($tableName) : $tableName;

        $eventClass = "App\\Events\\{$tableName}{$eventType}";

        if (class_exists($eventClass)) {
            event(new $eventClass($model));
        }
    }

    protected function inferEventType($model, $type)
    {
        return filled($type)
            ? $type
            : ($model->wasRecentlyCreated
                ? 'Created'
                : 'Updated');
    }
}
