<?php

namespace App\Data\Models;

class Legislature extends Base
{
    /**
     * @var array
     */
    protected $fillable = ['number', 'year_start', 'year_end', 'created_by_id'];
}
