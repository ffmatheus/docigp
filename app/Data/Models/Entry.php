<?php

namespace App\Data\Models;

class Entry extends Base
{
    protected $table = 'entries';

    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'value',
        'object',
        'to',
        'cycle_id',
        'verified_at',
        'authorised_at',
        'published_at',
        'verified_by_id',
        'authorised_by_id',
        'published_by_id',
        'created_by_id',
        'updated_by_id',
    ];

    protected $dates = ['date', 'verified_at', 'authorised_at', 'published_at'];

    public function file()
    {
        return $this->morphOne(AttachedFile::class, 'fileable');
    }
}
