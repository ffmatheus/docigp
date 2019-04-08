<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CpfCnpj\Service as CpfCnpjService;

class CpfCnpj extends Controller
{
    /**
     * Get all data
     *
     * @return array
     */
    public function check()
    {
        return app(CpfCnpjService::class)->check(request()->all());
    }
}
