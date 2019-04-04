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

    /**
     * Raw Columns to be selected in usual queries
     *
     * @var array|null
     */
    protected $selectColumnsRaw;

    public function getSelectColumns()
    {
        return coollect($this->selectColumns);
    }

    public function getSelectColumnsRaw()
    {
        return coollect($this->selectColumnsRaw);
    }
}
