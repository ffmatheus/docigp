<?php

namespace Tests\Browser\Pages;

use App\Data\Models\User;
use App\Data\Repositories\Users;
use App\Support\Constants;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersTest extends DuskTestCase
{
    private static $emailUsuarios;
    private static $nomeUsuarios;
    private static $randomUsers;
    private static $administrator;

    public function createAdminstrator()
    {
        static::$administrator = factory(
            User::class,
            Constants::ROLE_ADMINISTRATOR
        )->raw();
    }

    public function init()
    {
        $faker = app(Faker::class);
        static::$emailUsuarios = only_letters_and_space(
            app(Faker::class)->firstName
        );
        static::$nomeUsuarios = only_letters_and_space(app(Faker::class)->name);
        static::$randomUsers = app(Users::class)
            ->randomElement()
            ->toArray();
    }

    public function testInsert()
    {
        $this->createAdminstrator();
        $this->init();
        $nomeA = static::$nomeUsuarios;
        $emailA = static::$emailUsuarios . '@alerj.rj.gov.br';
        $roles = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            '11',
            '12',
            '13'
        ];
        $rolesA = $roles[array_rand($roles, 1)];
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use (
            $nomeA,
            $emailA,
            $rolesA,
            $administrator
        ) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/users#/')
                ->assertSee('Novo')
                ->press('#novo')
                ->type('#email', $emailA)
                ->type('#name', $nomeA)
                ->select('#all-roles', $rolesA)
                ->press('#add-profile-button')
                ->press('Gravar')
                ->assertSee($nomeA)
                ->assertSee($rolesA)
                ->assertSee($emailA);
        });
    }

    public function testValidation()
    {
        $administrator = static::$administrator;
        $roles = [
            'Administrador',
            'Chefe',
            'Gestor',
            'Assessor',
            'Operador',
            'Verificador',
            'ACI',
            'Assistente',
            'Funcionário',
            'Publicador',
            'Visualizador',
            'Financeiro'
        ];
        $rolesA = array_rand($roles, 1);

        $this->browse(function (Browser $browser) use (
            $roles,
            $rolesA,
            $administrator
        ) {
            $browser

                ->loginAs($administrator['id'])
                ->visit('admin/users#/')
                ->assertSee('Novo')
                ->press('#novo')
                ->select('#all-roles', $rolesA)
                ->press('#add-profile-button')
                ->waitFor('#assigned-roles', $rolesA)
                ->press('Gravar')
                ->assertSee('O campo e-mail é obrigatório.')
                ->assertSee('O campo nome é obrigatório.');
        });
    }
    public function testAlter()
    {
        $this->init();
        $nomeA = static::$nomeUsuarios;
        $randomUsers1 = static::$randomUsers;
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use (
            $nomeA,
            $randomUsers1,
            $administrator
        ) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/users/show/' . $randomUsers1['id'] . '#/')
                ->click('#vue-editButton')
                ->type('#name', '*' . $nomeA . '*')
                ->press('Gravar')
                ->assertSee('*' . $nomeA . '*');
        });
    }
    public function testWrongSearch()
    {
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use ($administrator) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/users#/')
                ->type('@search-input', '1323e12312vcxvdsf413543445654')
                ->click('@search-button')
                ->waitForText('Nenhum Usuário encontrado.')
                ->screenshot(
                    'Users-wrongsearch'
                )->assertSee('Nenhum Usuário encontrado.
');
        });
    }

    public function testRightSearch()
    {
        $this->init();
        $randomUsers1 = static::$randomUsers;
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use (
            $randomUsers1,
            $administrator
        ) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/users#/')
                ->type('@search-input', $randomUsers1['name'])
                ->click('@search-button')
                ->assertSee($randomUsers1['name'])
                ->screenshot('Users-rightsearch');
        });
    }
}
