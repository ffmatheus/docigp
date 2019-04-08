<?php

namespace App\Services\DataSync;

use App\Data\Repositories\Parties;
use App\Data\Repositories\Congressmen;
use App\Data\Repositories\Departaments;
use App\Services\HttpClient\Service as HttpClientService;
use PragmaRX\Coollection\Package\Coollection;
use Silber\Bouncer\BouncerFacade as Bouncer;

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

    public function roles()
    {
        $ci = app(Departaments::class)->findByInitials('CI');

        //        RoleRole
        //
        //        user
        //            departament_id
        //                Departamento de deputado
        //                    - acesso só ao que é do deputado
        //                CI
        //                    - analisar e publicar
        //                Informática
        //                    - dar permissão
        //                Diretoria geral
        //                    - ver
        //
        //        @can('acessar pag do deputado',$x)
        //
        //        Gate::
        //            user->isFromDepartament(X)
        //
        //        deputado
        //            legislatura
        //                orçamento
        //
        //        lançamento
        //            deputado - legisatura

        Bouncer::role()->firstOrCreate([
            'name' => 'Administrator',
            'title' => 'Administrator',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Deputado',
            'title' => 'Deputado',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Chefe',
            'title' => 'Chefe',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Gestor',
            'title' => 'Gestor',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Assessor',
            'title' => 'Assessor',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Lançador',
            'title' => 'Lançador',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Verificador',
            'title' => 'Verificador',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Diretor',
            'title' => 'Diretor',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Assistente',
            'title' => 'Assistente',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Gestor',
            'title' => 'Gestor',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Funcionário',
            'title' => 'Funcionário',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Publicador',
            'title' => 'Publicador',
        ]);
        Bouncer::role()->firstOrCreate([
            'name' => 'Visualizador',
            'title' => 'Visualizador',
        ]);
    }
}
