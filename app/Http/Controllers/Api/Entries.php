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
}
