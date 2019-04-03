<?php

namespace App\Data\Models;

class AttachedFile extends Base
{
    protected $fillable = [
        'file_id',
        'fileable_id',
        'fileable_type',
        'original_name',
        'mime_type',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
