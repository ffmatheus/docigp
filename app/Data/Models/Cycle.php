<?php

namespace App\Data\Models;

class Cycle extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'congressman_legislature_id',
        'year',
        'month',
        'published_at',
        'published_by_id',
        'created_by_id',
        'updated_by_id',
    ];

    protected $dates = ['published_at'];
}
