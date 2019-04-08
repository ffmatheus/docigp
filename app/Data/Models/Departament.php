<?php

namespace App\Data\Models;

class Departament extends Model
{
    protected $fillable = ['name', 'initials', 'congressman_id'];

    public function congressman()
    {
        $this->belongsTo(Congressman::class);
    }

    public function users()
    {
        $this->hasMany(Departament::class);
    }

    public function isCongressmanCabinet()
    {
        return filled($this->congressman_id);
    }
}
