<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Data\Models\User as UserModel;
use App\Data\Repositories\Users as UsersRepository;

use Silber\Bouncer\BouncerFacade as Bouncer;

class InsertRolesAndAbilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
