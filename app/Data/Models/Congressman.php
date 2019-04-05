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

    protected $with = ['party'];

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

    public function congressmanBudgets()
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

    /**
     * @return \App\Data\Models\CongressmanBudget|null
     */
    public function getCurrentBudgetAttribute()
    {
        return $this->congressmanBudgets()
            ->join(
                'budgets',
                'budgets.id',
                '=',
                'congressman_budgets.budget_id'
            )
            ->orderBy('budgets.date', 'desc')
            ->first();
    }

    /**
     * @param $congressmanBudget
     * @return \App\Data\Models\CongressmanBudget|null
     */
    public function getPriorBudgetRelativeTo($congressmanBudget)
    {
        return $this->congressmanBudgets()
            ->orderBy('budgets.date', 'desc')
            ->join(
                'budgets',
                'budgets.id',
                '=',
                'congressman_budgets.budget_id'
            )
            ->where(
                'budgets.date',
                '<',
                $congressmanBudget->budget->date->startOfMonth()
            )
            ->first();
    }

    /**
     * @param $congressmanBudget
     * @return \App\Data\Models\CongressmanBudget|null
     */
    public function getNextBudgetRelativeTo($congressmanBudget)
    {
        return $this->congressmanBudgets()
            ->orderBy('budgets.date', 'asc')
            ->join(
                'budgets',
                'budgets.id',
                '=',
                'congressman_budgets.budget_id'
            )
            ->where(
                'budgets.date',
                '>',
                $congressmanBudget->budget->date->endOfMonth()
            )
            ->first();
    }

    /**
     * @return \App\Data\Models\Legislature|null
     */
    public function getCurrentLegislatureAttribute()
    {
        return $this->legislatures()
            ->whereNull('ended_at')
            ->first();
    }

    public function file()
    {
        return $this->morphOne(AttachedFile::class, 'fileable');
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function departament()
    {
        $this->belongsTo(Departament::class);
    }
}
