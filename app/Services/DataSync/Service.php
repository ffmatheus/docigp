<?php

namespace App\Services\DataSync;

use Illuminate\Support\Collection;
use App\Data\Repositories\Congressmen;
use App\Services\HttpClient\Service as HttpClientService;

class Service
{
    const CONGRESSMEN_ENDPOINT = 'http://apiportal.alerj.rj.gov.br/api/v1.0/proderj/api/deputadoservice';

    public function congressmen()
    {
        $result = app(HttpClientService::class)->readJson(
            static::CONGRESSMEN_ENDPOINT
        );

        if ($result instanceof Collection) {
            app(Congressmen::class)->sync($result['data']);
        }
    }
}
