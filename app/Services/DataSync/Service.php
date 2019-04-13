<?php

namespace App\Services\DataSync;

use App\Data\Repositories\Parties;
use App\Data\Repositories\Congressmen;
use App\Data\Repositories\Departaments;
use App\Data\Repositories\Users;
use App\Services\HttpClient\Service as HttpClientService;
use PragmaRX\Coollection\Package\Coollection;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Silber\Bouncer\Database\Role as BouncerRole;
use Silber\Bouncer\Database\Ability as BouncerAbility;

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
            'title' => 'Administrator',
            'name' => 'administrator',
        ]);

        Bouncer::role()->firstOrCreate([
            'title' => 'Deputado',
            'name' => 'deputado',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Chefe',
            'name' => 'chefe',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Gestor',
            'name' => 'gestor',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Assessor',
            'name' => 'assessor',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Lançador',
            'name' => 'lancador',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Verificador',
            'name' => 'verificador',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Diretor',
            'name' => 'diretor',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Assistente',
            'name' => 'assistente',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Gestor',
            'name' => 'gestor',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Funcionário',
            'name' => 'funcionario',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Publicador',
            'name' => 'publicador',
        ]);
        Bouncer::role()->firstOrCreate([
            'title' => 'Visualizador',
            'name' => 'visualizador',
        ]);
    }

    public function abilities()
    {
        $allRoles = BouncerRole::all();

        $allRoles->each(function ($item, $key) {
            Bouncer::ability()->firstOrCreate([
                'name' => 'assign:' . $item->name,
                'title' => 'Atribuir perfil de ' . $item->name,
            ]);
        });
    }

    public function rolesAbilities()
    {
        $rolesArray = BouncerRole::all()->mapWithKeys(function ($item) {
            return [$item['name'] => $item];
        });

        $abilitiesArray = BouncerAbility::all()->mapWithKeys(function ($item) {
            return [$item['name'] => $item];
        });

        Bouncer::allow('administrator')->everything();

        Bouncer::allow($rolesArray['deputado'])->to('assign:chefe');
        Bouncer::allow($rolesArray['deputado'])->to('assign:gestor');
        Bouncer::allow($rolesArray['deputado'])->to('assign:assessor');
        Bouncer::allow($rolesArray['deputado'])->to('assign:lancador');
        Bouncer::allow($rolesArray['deputado'])->to('assign:verificador');

        Bouncer::allow($rolesArray['diretor'])->to('assign:assistente');
        Bouncer::allow($rolesArray['diretor'])->to('assign:gestor');
        Bouncer::allow($rolesArray['diretor'])->to('assign:funcionario');
        Bouncer::allow($rolesArray['diretor'])->to('assign:publicador');
        Bouncer::allow($rolesArray['diretor'])->to('assign:visualizador');
    }
}
