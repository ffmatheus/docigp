<?php

namespace App\Data\Models;

class Departament extends Model
{
    protected $fillable = ['name', 'initials', 'congressman_id'];

    public function congressman()
    {
        $this->hasOne(Congressman::class);
    }

    public function users()
    {
        $this->hasMany(Departament::class);
    }
}
