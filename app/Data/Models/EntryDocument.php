<?php

namespace App\Data\Models;

use App\Data\Traits\ModelActionable;
use App\Data\Scopes\Published;

class EntryDocument extends Model
{
    use ModelActionable;

    protected $fillable = [
        'entry_id',
        'disk_name',
        'path',
        'name',
        'analysed_at',
        'analysed_by_id',
        'published_at',
        'published_by_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new Published());
    }

    protected $selectColumns = ['entry_documents.*'];

    protected $dates = ['date', 'analysed_at', 'published_at'];

    protected $orderBy = ['id' => 'asc'];
}
