<?php

namespace App\Data\Models;

class Congressman extends Model
{
    protected $fillable = [
        'remote_id',
        'name',
        'nickname',
        'party_id',
        'photo_url',
        'thumbnail_url',
    ];

    protected $filterableColumns = ['name'];

    protected $orderBy = ['name' => 'asc'];

    protected $selectColumns = ['congressmen.*'];

    protected $selectColumnsRaw = [
        '(select count(*) from congressman_legislatures cl where cl.congressman_id = congressmen.id and cl.ended_at is null) > 0 as has_mandate',
        '(select count(*) from congressman_budgets cb join congressman_legislatures cl on cb.congressman_legislature_id = cl.id where cl.congressman_id = congressmen.id and cb.published_at is null) > 0 as has_pendency',
    ];

    public function legislatures()
    {
        return $this->hasMany(CongressmanLegislature::class);
    }

    public function budgets()
    {
        return $this->hasManyThrough(
            CongressmanBudget::class,
            CongressmanLegislature::class
        );
    }

    public function scopeActive($query)
    {
        return $query
            ->join(
                'congressman_legislatures',
                'congressman_legislatures.congressman_id',
                '=',
                'congressmen.id'
            )
            ->whereNull('congressman_legislatures.ended_at');
    }

    public function scopeNonActive($query)
    {
        return $query
            ->join(
                'congressman_legislatures',
                'congressman_legislatures.congressman_id',
                '=',
                'congressmen.id'
            )
            ->whereNotNull('congressman_legislatures.ended_at');
    }

    public function scopeWithPendency($query)
    {
        return $query->whereRaw(
            '(select count(*) from congressman_budgets cb join congressman_legislatures cl on cb.congressman_legislature_id = cl.id where cl.congressman_id = congressmen.id and cb.published_at is null) > 0'
        );
    }

    public function scopeWithoutPendency($query)
    {
        return $query->whereRaw(
            '(select count(*) from congressman_budgets cb join congressman_legislatures cl on cb.congressman_legislature_id = cl.id where cl.congressman_id = congressmen.id and cb.published_at is null) = 0'
        );
    }

    public function getCurrentBudgetAttribute()
    {
        return $this->budgets()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function getCurrentLegislatureAttribute()
    {
        return $this->legislatures()
            ->whereNull('ended_at')
            ->first();
    }

    public function party(){
        return $this->belongsTo(Party::class);
    }
}
