<?php

namespace App\Data\Models\Traits;

trait Filterable
{
    /**
     * Columns to be joined in usual queries
     *
     * @var array|null
     */
    protected $filterableColumns;

    public function getFilterableColumns()
    {
        return coollect($this->filterableColumns);
    }
}
