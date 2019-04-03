<?php

namespace App\Data\Models;

class File extends Base
{
    protected $fillable = ['sha1_hash', 'drive', 'path', 'remote_url'];

}
