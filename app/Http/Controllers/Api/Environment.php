<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Environment\Service as EnvironmentService;

class Environment extends Controller
{
    /**
     * Get all data
     *
     * @return \Illuminate\Http\Response|Collection
     */
    public function data()
    {
        return app(EnvironmentService::class)->data();
    }
}
