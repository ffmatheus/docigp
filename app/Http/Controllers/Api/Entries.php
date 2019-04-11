<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EntryStore;
use App\Http\Requests\EntryUpdate;
use App\Http\Controllers\Controller;
use App\Data\Repositories\Entries as EntriesRepository;

class Entries extends Controller
{
    /**
     * Get all data
     *
     * @param $congressmanId
     * @param $congressmanBudgetId
     * @return array
     */
    public function all($congressmanId, $congressmanBudgetId)
    {
        return app(EntriesRepository::class)->allFor(
            $congressmanId,
            $congressmanBudgetId
        );
    }

    public function verify($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->verify($entryId);
    }

    public function unverify($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->unverify($entryId);
    }

    public function analyse($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->analyse($entryId);
    }

    public function unanalyse($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->unanalyse($entryId);
    }

    public function delete($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->delete($entryId);
    }

    /**
     * Store
     *
     * @param EntryStore $request
     * @param $congressmanId
     * @param $congressmanBudgetId
     * @return mixed
     */
    public function store(
        EntryStore $request,
        $congressmanId,
        $congressmanBudgetId
    ) {
        return app(EntriesRepository::class)
            ->setCongressmanBudgetId($congressmanBudgetId)
            ->setData($request->all())
            ->store();
    }

    /**
     * @param EntryUpdate $request
     * @param $id
     * @return mixed
     */
    public function update(
        EntryUpdate $request,
        $congressmanId,
        $congressmanBudgetId,
        $entryId
    ) {
        return app(EntriesRepository::class)
            ->setCongressmanBudgetId($congressmanBudgetId)
            ->setData($request->all())
            ->update($entryId);
    }
}
