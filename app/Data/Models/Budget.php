<?php

namespace App\Data\Models;

class Budget extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['date', 'value', 'created_by_id', 'updated_by_id'];

    protected $dates = ['date'];
}
