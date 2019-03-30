<?php

namespace App\Data\Models\Traits;

trait Selectable
{
    /**
     * Columns to be selected in usual queries
     *
     * @var array|null
     */
    protected $selectColumns;

    public function getSelectColumns()
    {
        return collect($this->selectColumns);
    }
}
