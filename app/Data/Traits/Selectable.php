<?php

namespace App\Data\Traits;

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
        return $this->replaceWheres(coollect($this->selectColumnsRaw));
    }

    public function replaceWheres($selects)
    {
        return $selects->map(function ($select) {
            return $this->replaceWhere($select);
        });
    }

    public function replaceWhere($select)
    {
        return str_replace(
            ':published-at-filter:',
            !auth()->user() ? 'and published_at is not null' : '',
            $select
        );
    }
}
