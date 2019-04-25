<?php

namespace App\Data\Models;

class CostCenter extends Model
{
    protected $fillable = [
        'code',
        'name',
        'parent_code',
        'limit',
        'frequency',
        'can_accumulate',
        'created_by_id',
        'updated_by_id',
    ];

    protected $orderBy = ['code' => 'asc'];
}
