<?php

namespace App\Data\Models;

use App\Data\Scopes\Published;
use App\Data\Traits\ModelActionable;

class EntryDocument extends Model
{
    use ModelActionable;

    protected $fillable = [
        'entry_id',
        'attached_file_id',
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

    protected $selectColumns = [
        'entry_documents.*',
        'attached_files.original_name as name',
    ];

    protected $dates = ['date', 'analysed_at', 'published_at'];

    protected $orderBy = ['id' => 'asc'];

    protected $joins = [
        'attached_files' => [
            'attached_files.id',
            '=',
            'entry_documents.attached_file_id',
        ],
    ];

    public function attachedFile()
    {
        $this->belongsTo(AttachedFile::class);
    }

    public function entry()
    {
        $this->belongsTo(Entry::class);
    }
}
