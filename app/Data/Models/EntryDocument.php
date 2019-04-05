<?php

namespace App\Data\Models;

use App\Data\Traits\ModelActionable;

class EntryDocument extends Model
{
    use ModelActionable;

    protected $fillable = [
        'entry_id',
        'disk_name',
        'path',
        'name',
        'approved_at',
        'approved_by_id',
        'published_at',
        'published_by_id',
    ];

    protected $selectColumns = ['entry_documents.*'];

    protected $dates = ['date', 'approved_at', 'published_at'];

    protected $orderBy = ['id' => 'asc'];
}
