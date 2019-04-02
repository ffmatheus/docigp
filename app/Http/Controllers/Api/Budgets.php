<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BudgetStore;
use App\Http\Requests\BudgetUpdate;
use App\Data\Repositories\Budgets as BudgetsRepository;

class Budgets extends Controller
{
    /**
     * Get all data
     *
     * @return array
     */
    public function all()
    {
        return app(BudgetsRepository::class)->all();
    }

    /**
     * Store
     *
     * @param BudgetStore $request
     * @return mixed
     */
    public function store(BudgetStore $request)
    {
        return app(BudgetsRepository::class)->storeFromArray($request->all());
    }

    /**
     * @param BudgetUpdate $request
     * @param $id
     * @return mixed
     */
    public function update(BudgetUpdate $request, $id)
    {
        return app(BudgetsRepository::class)->update($id, $request->all());
    }

    /**
     * Get all data
     *
     * @return array
     */
    public function availableBudgets()
    {
        return app(BudgetsRepository::class)->getAvailableBudgets();
    }
}
