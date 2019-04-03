<?php

namespace App\Data\Models;

class CongressmanBudget extends Base
{
    /**
     * @var array
     */
    protected $fillable = [
        'congressman_id',
        'budget_id',
        'percentage',
        'approved_by_id',
        'approved_at',
        'published_by_id',
        'published_at',
    ];
}
