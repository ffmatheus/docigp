<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryDocumentStore;
use App\Data\Repositories\EntryDocuments as EntryDocumentsRepository;

class EntryDocuments extends Controller
{
    /**
     * Get all data
     *
     * @param $congressmanId
     * @param $congressmanBudgetId
     * @return array
     */
    public function all($congressmanId, $congressmanBudgetId, $entryId)
    {
        return app(EntryDocumentsRepository::class)->allFor(
            $congressmanId,
            $congressmanBudgetId,
            $entryId
        );
    }

    /**
     * Store
     *
     * @param \App\Http\Requests\EntryDocumentStore $request
     * @param $congressmanId
     * @param $congressmanBudgetId
     * @param $entryId
     * @return mixed
     */
    public function store(
        EntryDocumentStore $request,
        $congressmanId,
        $congressmanBudgetId,
        $entryId
    ) {
        return app(EntryDocumentsRepository::class)
            ->setEntryId($entryId)
            ->setData($request->all())
            ->store();
    }

    public function publish(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->publish($entryDocumentId);
    }

    public function unpublish(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->unpublish($entryDocumentId);
    }

    public function analyse(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->analyse($entryDocumentId);
    }

    public function unanalyse(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->unanalyse($entryDocumentId);
    }
}
