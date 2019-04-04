<?php

namespace App\Data\Models;

class File extends Model
{
    protected $fillable = ['sha1_hash', 'drive', 'path', 'remote_url'];

}
