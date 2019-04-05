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

    public function publish($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntryDocumentsRepository::class)->publish($entryId);
    }

    public function unpublish($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntryDocumentsRepository::class)->unpublish($entryId);
    }

    public function approve($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntryDocumentsRepository::class)->approve($entryId);
    }

    public function unapprove($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntryDocumentsRepository::class)->unapprove($entryId);
    }
}
