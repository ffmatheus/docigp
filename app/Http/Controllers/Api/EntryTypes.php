<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Data\Repositories\EntryTypes as EntryTypesRepository;

class EntryTypes extends Controller
{
    /**
     * Get all data
     *
     * @return array
     */
    public function all()
    {
        $repository = app(EntryTypesRepository::class);

        $repository->disablePagination();

        return $repository->all();
    }
}
