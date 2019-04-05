<?php

namespace App\Data\Traits;

trait Orderable
{
    /**
     * Columns to be joined in usual queries
     *
     * @var array|null
     */
    protected $orderBy;

    public function getOrderBy()
    {
        return coollect($this->orderBy);
    }
}
