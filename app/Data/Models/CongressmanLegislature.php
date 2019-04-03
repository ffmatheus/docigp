<?php

namespace App\Data\Models;

class CongressmanLegislature extends Base
{
    /**
     * @var array
     */
    protected $fillable = [
        'congressman_id',
        'legislature_id',
        'started_at',
        'ended_at',
        'created_by_id',
        'updated_by_id',
    ];

    protected $dates = ['started_at', 'ended_at'];
}
