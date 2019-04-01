<?php

namespace App\Data\Models;

class CongressmanBudget extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['congressman_id', 'budget_id', 'percentage'];
}
