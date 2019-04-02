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

    public function legislatures()
    {
        return $this->belongsToMany(
            Legislature::class,
            'congressman_legislatures'
        );
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
}
