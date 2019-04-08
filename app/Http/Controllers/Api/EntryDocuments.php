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

    public function comply(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->comply($entryDocumentId);
    }

    public function uncomply(
        $congressmanId,
        $congressmanBudgetId,
        $entryId,
        $entryDocumentId
    ) {
        app(EntryDocumentsRepository::class)->uncomply($entryDocumentId);
    }
}
