<?php

namespace App\Data\Models;

use \App\AttachedFile;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = [
        '',
    ];

    public function file()
    {
        return $this->morphOne(AttachedFile::class, 'file');
    }
}
