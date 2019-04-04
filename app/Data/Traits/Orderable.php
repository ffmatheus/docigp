<?php

namespace App\Data\Models\Traits;

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
