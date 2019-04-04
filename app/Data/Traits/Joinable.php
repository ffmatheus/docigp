<?php

namespace App\Data\Traits;

trait Joinable
{
    /**
     * Columns to be joined in usual queries
     *
     * @var array|null
     */
    protected $joins;

    public function getJoins()
    {
        return coollect($this->joins);
    }
}
