<?php

namespace App\Services\DataSync;

use App\Data\Repositories\Parties;
use App\Data\Repositories\Congressmen;
use App\Data\Repositories\Departaments;
use Silber\Bouncer\BouncerFacade as Bouncer;
use PragmaRX\Coollection\Package\Coollection;
use App\Services\HttpClient\Service as HttpClientService;

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
        collect(config('departments.list'))->each(function ($department) {
            app(Departaments::class)->firstOrCreate($department);
        });
    }

    public function roles()
    {
        collect(config('roles.roles'))->each(function ($role) {
            Bouncer::role()->updateOrCreate(
                [
                    'name' => $role['name'],
                ],
                [
                    'title' => $role['title'],
                ]
            );
        });

        $this->rolesAbilities();
    }

    public function rolesAbilities()
    {
        collect(config('roles.grants'))->each(function ($grant) {
            collect($grant['abilities'])->each(function ($title, $ability) use (
                $grant
            ) {
                Bouncer::ability()->updateOrCreate(
                    [
                        'name' => $ability,
                    ],
                    [
                        'title' => $title,
                    ]
                );

                if (in($ability, 'everything', '*')) {
                    Bouncer::allow($grant['group'])->everything();
                } else {
                    Bouncer::allow($grant['group'])->to($ability);
                }
            });
        });
    }
}
