<?php

namespace App\Services\DataSync;

use App\Data\Repositories\Parties;
use App\Data\Repositories\Congressmen;
use App\Data\Repositories\Departaments;
use App\Services\HttpClient\Service as HttpClientService;
use PragmaRX\Coollection\Package\Coollection;

class Service
{
    const CONGRESSMEN_ENDPOINT = 'http://apiportal.alerj.rj.gov.br/api/v1.0/proderj/api/deputadoservice';

    const PARTIES_ENDPOINT = 'https://dadosabertos.camara.leg.br/api/v2/partidos?dataInicio=1970-01-01&itens=500&ordem=ASC&ordenarPor=sigla&pagina=%s';

    public function congressmen()
    {
        $result = app(HttpClientService::class)->readJson(
            static::CONGRESSMEN_ENDPOINT
        );

        if ($result instanceof Coollection) {
            app(Congressmen::class)->sync($result['data']);
        }
    }

    public function parties()
    {
        $page = 1;

        while (true) {
            $result = app(HttpClientService::class)->readJson(
                sprintf(static::PARTIES_ENDPOINT, $page++)
            );

            if (
                $result instanceof Coollection &&
                count($result['data']['dados']) > 0
            ) {
                app(Parties::class)->sync($result['data']['dados']);
            } else {
                break;
            }
        }
    }

    public function departaments()
    {
        $result = app(Departaments::class)->createCIDepartament();
    }
}
