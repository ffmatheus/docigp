<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function approve(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->approve($entryDocumentId);
    }

    public function unapprove(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->unapprove($entryDocumentId);
    }
}
