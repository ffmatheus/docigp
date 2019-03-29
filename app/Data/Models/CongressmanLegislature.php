<?php

namespace App\Data\Models;

class Legislature extends Model
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
}
