<?php

namespace App\Data\Models;

use App\Data\Traits\ModelActionable;

class Entry extends Model
{
    use ModelActionable;

    protected $table = 'entries';

    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'value',
        'object',
        'to',
        'cycle_id',
        'verified_at',
        'approved_at',
        'published_at',
        'verified_by_id',
        'approved_by_id',
        'published_by_id',
        'created_by_id',
        'updated_by_id',
    ];

    protected $dates = ['date', 'verified_at', 'approved_at', 'published_at'];

    protected $selectColumns = ['entries.*'];

    protected $selectColumnsRaw = [
        '(select count(*) from entry_documents ed where ed.entry_id = entries.id) as documents_count',
        '(select count(*) from entry_documents ed where ed.entry_id = entries.id and ed.approved_at is null) > 0 as has_pendency',
    ];

    protected $filterableColumns = [
        'entries.to',
        'entries.object',
        'entries.value',
    ];

    protected $orderBy = ['date' => 'desc'];

    public function documents()
    {
        return $this->hasMany(EntryDocument::class);
    }

    public function congressmanBudget()
    {
        return $this->belongsTo(CongressmanBudget::class);
    }

    public function file()
    {
        return $this->morphOne(AttachedFile::class, 'fileable');
    }
}
