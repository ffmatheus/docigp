<?php

namespace App\Data\Models;

use App\Data\Scopes\Published as PublishedScope;
use App\Data\Scopes\Congressman as CongressmanScope;
use Illuminate\Support\Facades\DB;

class Congressman extends Model
{
    protected $fillable = [
        'remote_id',
        'name',
        'nickname',
        'party_id',
        'photo_url',
        'thumbnail_url',
        'department_id',
    ];

    protected $with = ['party', 'user'];

    protected $filterableColumns = ['name', 'nickname'];

    protected $orderBy = ['name' => 'asc'];

    protected $selectColumns = ['congressmen.*'];

    protected $appends = ['thumbnail_url_linkable', 'photo_url_linkable'];

    protected $selectColumnsRaw = [
        '(select count(*) from congressman_legislatures cl where cl.congressman_id = congressmen.id and cl.ended_at is null) > 0 as has_mandate',
        '(select count(*) from congressman_budgets cb join congressman_legislatures cl on cb.congressman_legislature_id = cl.id where cl.congressman_id = congressmen.id and cb.published_at is null) > 0 as has_pendency',
    ];

    public function legislatures()
    {
        return $this->hasMany(CongressmanLegislature::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
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
            ->whereNotNull('congressman_legislatures.ended_at')
            ->whereNotExists(function ($query) {
                $query
                    ->select(DB::raw(1))
                    ->from('congressman_legislatures')
                    ->whereRaw(
                        'congressman_legislatures.congressman_id = congressmen.id'
                    )
                    ->whereNull('congressman_legislatures.ended_at');
            });
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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CongressmanScope());
    }

    public static function disableGlobalScopes()
    {
        PublishedScope::disable();
        CongressmanScope::disable();
    }

    public static function enableGlobalScopes()
    {
        PublishedScope::disable();
        CongressmanScope::enable();
    }

    public function getThumbnailUrlLinkableAttribute()
    {
        return filled($this->thumbnail_url)
            ? 'http://' . trim($this->thumbnail_url)
            : null;
    }

    public function getPhotoUrlLinkableAttribute()
    {
        return filled($this->photo_url)
            ? 'http://' . trim($this->photo_url)
            : null;
    }
}
