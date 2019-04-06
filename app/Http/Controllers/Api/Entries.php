<?php

namespace App\Http\Controllers\Api;

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

    public function comply($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->comply($entryId);
    }

    public function uncomply($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->uncomply($entryId);
    }

    public function delete($congressmanId, $congressmanBudgetId, $entryId)
    {
        app(EntriesRepository::class)->delete($entryId);
    }
}
