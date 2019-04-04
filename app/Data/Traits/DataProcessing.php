<?php

namespace App\Data\Traits;

use Illuminate\Database\Eloquent\Model;

trait DataProcessing
{
    protected $plugins = ['data' => [], 'transformation' => []];

    /**
     * @param callable $plugin
     */
    public function addDataPlugin($plugin)
    {
        $this->plugins['data'][] = $plugin;

        return $this;
    }

    /**
     * @param callable $plugin
     */
    public function addTransformationPlugin($plugin)
    {
        $this->plugins['transformation'][] = $plugin;

        return $this;
    }

    public function processTransformationPlugins($data)
    {
        return $this->processPlugins(
            $data,
            $this->plugins['transformation'],
            true
        );
    }

    public function processDataPlugins($data)
    {
        return $this->processPlugins($data, $this->plugins['data'], false);
    }

    public function processPlugins($data, $plugins, $convertToArray)
    {
        coollect($plugins)->each(function ($plugin) use (
            &$data,
            $convertToArray
        ) {
            $data = coollect($data)->map(function ($item) use (
                $plugin,
                $convertToArray
            ) {
                if ($convertToArray && $item instanceof Model) {
                    $item = $item->toArray();
                }

                $item = $plugin($item);

                return $item;
            });
        });

        return $data;
    }

    public function transform($data)
    {
        return $this->processTransformationPlugins(
            $this->processDataPlugins($data)
        );
    }
}
