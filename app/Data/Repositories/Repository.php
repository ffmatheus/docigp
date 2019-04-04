<?php

namespace App\Data\Repositories;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Data\Traits\Eventable;
use App\Data\Traits\DataProcessing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

abstract class Repository
{
    use DataProcessing, Eventable;

    /**
     * @var
     */
    protected $model;

    protected function buildJoins($query)
    {
        $this->model()
            ->getJoins()
            ->each(function ($join, $table) use ($query) {
                $query->join($table, $join[0], $join[1], $join[2]);
            });
    }

    /**
     * @param $query
     */
    protected function buildSelect($query)
    {
        $columns = $this->model()->getSelectColumns();

        if ($columns->count() > 0) {
            $query->select($columns->toArray());
        }

        $columnsRaw = $this->model()->getSelectColumnsRaw();

        if ($columnsRaw->count() > 0) {
            $columnsRaw->each(function ($select) use ($query) {
                $query->selectRaw($select);
            });
        }
    }

    /**
     * Filter Checkboxes
     *
     * @param $query
     * @param array $filter
     * @return mixed
     */
    protected function filterCheckboxes($query, array $filter)
    {
        return $query;
    }

    /**
     * Filter Selects
     *
     * @param $query
     * @param array $filter
     * @return mixed
     */
    protected function filterSelects($query, array $filter)
    {
        return $query;
    }

    protected function qualifyColumn($name)
    {
        return $this->model()->qualifyColumn($name);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $model = is_null($id = isset($data['id']) ? $data['id'] : null)
            ? new $this->model()
            : $this->newQuery()
                ->where('id', $id)
                ->first();

        $model->fill($data);

        $model->save();

        return $model;
    }

    protected function allElements($queryFilter)
    {
        $array = $queryFilter->toArray();

        $array['pagination']['per_page'] = $this->count();
        $array['pagination']['current_page'] = 1;

        return coollect($array);
    }

    protected function applyFilter($query)
    {
        $queryFilter = $this->getQueryFilter();

        $this->filterText($queryFilter, $query);

        $this->order($query);

        if (
            isset($queryFilter->toArray()['pagination']['current_page']) &&
            $queryFilter->toArray()['pagination']['current_page'] == 0
        ) {
            $queryFilter = $this->allElements($queryFilter);
        }

        return $this->makePaginationResult(
            $query->paginate(
                $queryFilter->pagination && $queryFilter->pagination->perPage
                    ? $queryFilter->pagination->perPage
                    : 5,
                ['*'],
                'page',
                $queryFilter->pagination &&
                $queryFilter->pagination->currentPage
                    ? $queryFilter->pagination->currentPage
                    : 1
            )
        );
    }

    protected function filterAllColumns($query, $text)
    {
        if (
            $this->model()
                ->getFilterableColumns()
                ->count() > 0
        ) {
            $query->where(function ($newQuery) use ($query, $text) {
                $this->model()
                    ->getFilterableColumns()
                    ->each(function ($column) use ($newQuery, $text) {
                        $newQuery->orWhere($column, 'ilike', "%{$text}%");
                    });
            });
        }

        return $query;
    }

    /**
     * @param $filter
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function filterText($filter, $query)
    {
        if ($text = $filter['filter']['text']) {
            $this->filterAllColumns($query, $text);
        }

        if (
            isset($filter['filter']['checkboxes']) &&
            ($checkboxes = array_filter($filter['filter']['checkboxes']))
        ) {
            $this->filterCheckboxes($query, $checkboxes);
        }

        if (
            isset($filter['filter']['selects']) &&
            ($selects = array_filter($filter['filter']['selects']))
        ) {
            $this->filterSelects($query, $selects);
        }

        return $query;
    }

    protected function findByAnyColumnName($name, $arguments)
    {
        return $this->makeQueryByAnyColumnName(
            'findBy',
            $name,
            $arguments
        )->first();
    }

    protected function generatePages(LengthAwarePaginator $data)
    {
        $pageLimit = 6;

        $firstPage =
            $data->lastPage() > $pageLimit
                ? max($data->currentPage() - 2, 1)
                : 1;

        $lastPage = min($firstPage + $pageLimit, $data->lastPage());

        return range($firstPage, $lastPage);
    }

    protected function filterByAnyColumnName($columns, $arguments)
    {
        $query = $this->newQuery();

        coollect((array) $columns)->each(function ($column) use (
            $query,
            $arguments
        ) {
            $this->makeQueryByAnyColumnName(
                'filterBy',
                $column,
                $arguments,
                $query
            );
        });

        return $this->applyFilter($query);
    }

    protected function getByAnyColumnName($name, $arguments)
    {
        return $this->makeQueryByAnyColumnName(
            'getBy',
            $name,
            $arguments
        )->get();
    }

    protected function getQueryFilter()
    {
        $queryFilter = json_decode(request()->get('query'), true);

        $queryFilter['pagination'] = $queryFilter['pagination'] ?? [];

        $queryFilter['pagination']['current_page'] =
            $queryFilter['pagination']['current_page'] ?? 1;

        $queryFilter['pagination']['per_page'] =
            $queryFilter['pagination']['per_page'] ?? 20;

        return coollect($queryFilter);
    }

    protected function makeQueryByAnyColumnName(
        $type,
        $name,
        $arguments,
        $query = null
    ) {
        if (!$query) {
            $query = $this->newQuery($type);
        }

        $columnName = snake_case(Str::after($name, $type));

        return $query->where($this->qualifyColumn($columnName), $arguments);
    }

    /**
     * @param array $search
     * @param array $attributes
     *
     * @return mixed
     */
    public function firstOrCreate(array $search, array $attributes = [])
    {
        return $this->model::firstOrCreate($search, $attributes);
    }

    /**
     * @return mixed
     */
    public function new()
    {
        return new $this->model();
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return $this->new();
    }

    protected function order($query)
    {
        if (
            $query instanceof QueryBuilder ||
            $query instanceof EloquentBuilder
        ) {
            foreach ($this->new()->getOrderBy() as $field => $direction) {
                $query->orderBy($field, $direction);
            }
        }

        return $query;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->applyFilter($this->newQuery());
    }

    /**
     * @param $perPage
     * @param $total
     * @return float
     */
    protected function maxPage($perPage, $total)
    {
        return ceil($total / $perPage);
    }

    /**
     * @param $current
     * @param $perPage
     * @param $total
     * @return int
     */
    protected function fixCurrentPage($current, $perPage, $total)
    {
        if ($current > $this->maxPage($perPage, $total)) {
            return 1;
        } else {
            return $current;
        }
    }

    /**
     * Make pagination data.
     *
     * @param LengthAwarePaginator $data
     * @return array
     */
    protected function makePaginationResult(LengthAwarePaginator $data)
    {
        return [
            'links' => [
                'pagination' => [
                    'total' => $data->total(),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'from' => ($from =
                        ($data->currentPage() - 1) * $data->perPage() + 1),
                    'to' => $from + count($data->items()) - 1,
                    'pages' => $this->generatePages($data),
                ],
            ],

            'filter' => $this->getQueryFilter()['filter'],

            'rows' => $this->transform($data->items()),
        ];
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    public function cleanString($string)
    {
        return str_replace(["\n"], [''], $string);
    }

    /**
     * @param null $type
     * @return Builder
     */
    protected function newQuery($type = null)
    {
        $query = $this->model::query();

        $this->buildSelect($query);

        $this->buildJoins($query);

        return $query;
    }

    /**
     * @param Request $request
     * @param $model
     */
    protected function saveTags($request, $model)
    {
        if (isset($request['tags'])) {
            $model->syncTags($request['tags']);
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if (starts_with($name, 'findBy')) {
            return $result = $this->findByAnyColumnName($name, $arguments);
        }

        if (starts_with($name, 'filterBy')) {
            return $result = $this->filterByAnyColumnName($name, $arguments);
        }

        if (starts_with($name, 'getBy')) {
            return $result = $this->getByAnyColumnName($name, $arguments);
        }

        throw new Exception('Method not found: ' . $name);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return app(static::class)->__call($name, $arguments);
    }

    /**
     * Get a random element.
     *
     * @return mixed
     */
    public function randomElement()
    {
        return $this->model::inRandomOrder()->first();
    }

    /**
     * @param $array
     * @return mixed
     */
    public function storeFromArray($array)
    {
        return $this->fillAndSave($array, new $this->model());
    }

    /**
     * @param $id
     * @param $array
     * @return mixed
     */
    public function update($id, $array)
    {
        return $this->fillAndSave($array, $this->findById($id));
    }

    /**
     * @param $array
     * @param $model
     * @return mixed
     */
    protected function fillAndSave($array, $model)
    {
        $model->fill($array);

        $model->save();

        return $model;
    }

    public function count()
    {
        return $this->model::count();
    }

    public function selectRelatedClient($modelId)
    {
        $model = $this->model()
            ->withoutGlobalScopes([CurrentClient::class])
            ->find($modelId);

        set_current_client_id($model->client_id);

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Coollection|static[]
     */
    public function search(Request $request)
    {
        return $this->searchFromRequest($request->get('search'));
    }

    /**
     * @param $result
     * @param string $label
     * @param string $value
     *
     * @return mixed
     */
    protected function makeResultForSelect(
        $result,
        $label = 'name',
        $value = 'id'
    ) {
        return $result->map(function ($row) use ($value, $label) {
            $row['text'] = empty($row->text) ? $row[$label] : $row->text;

            $row['value'] = $row[$value];

            return $row;
        });
    }

    public function createFromRequest($request)
    {
        if ($request instanceof Request) {
            $request = $request->all();
        }

        $id = isset($request['id']) ? $request['id'] : null;

        $model = is_null($id)
            ? new $this->model()
            : $this->model::withoutGlobalScopes()->find($id);

        $model->fill($request);

        $model->save();

        return $model;
    }
}
