<?php

namespace App\Data\Models;

class Entry extends Model
{
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

    protected $filterableColumns = [
        'entries.to',
        'entries.object',
        'entries.value',
    ];

    protected $orderBy = ['date' => 'desc'];

    public function verify()
    {
        $this->update([
            'verified_at' => now(),
            'verified_by_id' => auth()->user()->id,
        ]);
    }

    public function unverify()
    {
        $this->update([
            'verified_at' => null,
            'verified_by_id' => auth()->user()->id,
        ]);

        $this->unapprove();
    }

    public function approve()
    {
        $this->update([
            'approved_at' => now(),
            'approved_by_id' => auth()->user()->id,
        ]);
    }

    public function unapprove()
    {
        $this->update([
            'approved_at' => null,
            'approved_by_id' => auth()->user()->id,
        ]);

        $this->unpublish();
    }

    public function publish()
    {
        $this->update([
            'published_at' => now(),
            'published_by_id' => auth()->user()->id,
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'published_at' => null,
            'published_by_id' => auth()->user()->id,
        ]);
    }
}
