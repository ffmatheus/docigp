<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CongressmanStore;
use App\Http\Requests\CongressmanUpdate;
use App\Data\Repositories\CongressmanBudgets as CongressmanBudgetsRepository;

class CongressmanBudgets extends Controller
{
    /**
     * Get all data
     *
     * @param $congressmanId
     * @return array
     */
    public function all($congressmanId)
    {
        return app(CongressmanBudgetsRepository::class)->allFor($congressmanId);
    }

    /**
     * Store
     *
     * @param CongressmanStore $request
     * @return mixed
     */
    public function store(CongressmanStore $request)
    {
        return app(CongressmanBudgetsRepository::class)->storeFromArray(
            $request->all()
        );
    }

    /**
     * @param CongressmanUpdate $request
     * @param $id
     * @return mixed
     */
    public function update(CongressmanUpdate $request, $id)
    {
        return app(CongressmanBudgetsRepository::class)->update(
            $id,
            $request->all()
        );
    }

    /**
     * Get all data
     *
     * @return array
     */
    public function availableCongressmanBudgets()
    {
        return app(
            CongressmanBudgetsRepository::class
        )->getAvailableCongressmanBudgets();
    }
}
