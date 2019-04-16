<?php

namespace App\Data\Models;

use App\Data\Scopes\Published;
use App\Data\Traits\ModelActionable;

class EntryDocument extends Model
{
    use ModelActionable;

    protected $fillable = [
        'entry_id',
        'analysed_at',
        'analysed_by_id',
        'published_at',
        'published_by_id',
    ];

    protected $selectColumns = ['entry_documents.*'];

    protected $dates = ['date', 'analysed_at', 'published_at'];

    protected $orderBy = ['id' => 'asc'];

    protected $joins = [];

    protected $appends = ['url'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new Published());
    }

    public function attachedFile()
    {
        return $this->morphOne(AttachedFile::class, 'fileable');
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    public function getUrlAttribute()
    {
        return $this->attachedFile->file->url;
    }
}
