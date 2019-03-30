<?php

namespace App\Data\Models;

class Congressman extends Model
{
    protected $fillable = [
        'remote_id',
        'name',
        'nickname',
        'party_id',
        'nickname',
        'photo_url',
        'thumbnail_url',
    ];
}
