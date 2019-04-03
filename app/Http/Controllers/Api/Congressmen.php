<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CongressmanStore;
use App\Http\Requests\CongressmanUpdate;
use App\Data\Repositories\Congressmen as CongressmenRepository;

class Congressmen extends Controller
{
    /**
     * Get all data
     *
     * @return array
     */
    public function all()
    {
        return app(CongressmenRepository::class)->all();
    }

    /**
     * Store
     *
     * @param CongressmanStore $request
     * @return mixed
     */
    public function store(CongressmanStore $request)
    {
        return app(CongressmenRepository::class)->storeFromArray(
            $request->all()
        );
    }

    /**
     * @param CongressmanUpdate $request
     * @param $id
     * @return mixed
     */
    public function update(CongressmanUpdate $request, $id)
    {
        return app(CongressmenRepository::class)->update($id, $request->all());
    }

    /**
     * Get all data
     *
     * @return array
     */
    public function availableCongressmen()
    {
        return app(CongressmenRepository::class)->getAvailableCongressmen();
    }
}
