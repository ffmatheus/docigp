<?php

namespace App\Data\Models;

class Legislature extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['number', 'year_start', 'year_end', 'created_by_id'];

    protected $dates = ['year_start', 'year_end'];
}
