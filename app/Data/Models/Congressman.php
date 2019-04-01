<?php

namespace App\Data\Models;

class Congressman extends Model
{
    protected $fillable = [
        'remote_id',
        'name',
        'nickname',
        'party_id',
        'photo_url',
        'thumbnail_url',
    ];

    public function legislatures()
    {
        return $this->belongsToMany(
            Legislature::class,
            'congressman_legislatures'
        );
    }
}
