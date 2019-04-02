<?php

namespace App\Data\Repositories;

use App\Data\Models\Legislature as LegislatureModel;

class Legislatures extends Repository
{
    /**
     * @var string
     */
    protected $model = LegislatureModel::class;

    public function searchFromRequest($search = null)
    {
        $search = is_null($search)
            ? collect()
            : collect(explode(' ', $search))->map(function ($item) {
                return strtolower($item);
            });

        $columns = collect(['number' => 'string']);

        $query = LegislatureModel::query();

        $search->each(function ($item) use ($columns, $query) {
            $columns->each(function ($type, $column) use ($query, $item) {
                if ($type === 'string') {
                    $query->orWhere(
                        DB::raw("lower({$column})"),
                        'like',
                        '%' . $item . '%'
                    );
                } else {
                    if ($this->isDate($item)) {
                        $query->orWhere($column, '=', $item);
                    }
                }
            });
        });

        return $this->makeResultForSelect($query->orderBy('number')->get());
    }

    public function getCurrent()
    {
        return $this->newQuery()
            ->orderBy('year_end', 'desc')
            ->first();
    }
}
