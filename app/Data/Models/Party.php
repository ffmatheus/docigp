<?php

namespace App\Data\Models;

class Party extends Model
{
    protected $fillable = ['code', 'name'];

    protected $orderBy = ['name' => 'asc'];

    protected $filterableColumns = ['name', 'code'];
}
