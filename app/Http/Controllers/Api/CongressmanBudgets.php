<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CongressmanStore;
use App\Http\Requests\CongressmanBudgetUpdate;
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
     * @param CongressmanBudgetUpdate $request
     * @param $id
     * @return mixed
     */
    public function update(CongressmanBudgetUpdate $request, $id)
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

    public function analyse($congressmanId, $congressmanBudgetId)
    {
        app(CongressmanBudgetsRepository::class)->analyse($congressmanBudgetId);
    }

    public function unanalyse($congressmanId, $congressmanBudgetId)
    {
        app(CongressmanBudgetsRepository::class)->unanalyse(
            $congressmanBudgetId
        );
    }

    public function publish($congressmanId, $congressmanBudgetId)
    {
        app(CongressmanBudgetsRepository::class)->publish($congressmanBudgetId);
    }

    public function unpublish($congressmanId, $congressmanBudgetId)
    {
        app(CongressmanBudgetsRepository::class)->unpublish(
            $congressmanBudgetId
        );
    }

    public function deposit($congressmanId, $congressmanBudgetId)
    {
        app(CongressmanBudgetsRepository::class)->deposit($congressmanBudgetId);
    }
}
