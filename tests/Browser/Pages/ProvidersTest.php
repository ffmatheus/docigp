<?php

namespace Tests\Browser\Pages;

use App\Data\Models\User;
use App\Data\Repositories\Providers;
use App\Support\Constants;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Company;
use Faker\Provider\pt_BR\Person;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProvidersTest extends DuskTestCase
{
    private static $nomeFornecedores;
    private static $cpfFornecedores;
    private static $cnpjFornecedores;
    private static $randomProviders;
    private static $administrator;

    public function createAdministrator()
    {
        static::$administrator = factory(
            User::class,
            Constants::ROLE_ADMINISTRATOR
        )->raw();
    }

    public function init()
    {
        static::$nomeFornecedores = only_letters_and_space(
            app(Faker::class)->name
        );
        static::$cpfFornecedores = app(Person::class)->cpf(true);
        static::$cnpjFornecedores = app(Company::class)->cnpj(true);
        static::$randomProviders = app(Providers::class)
            ->randomElement()
            ->toArray();
    }

    public function testInsertCPF()
    {
        $this->createAdministrator();
        $this->init();
        $TipoPessoa = 'PF';
        $nomeA = static::$nomeFornecedores;
        $cpfA = static::$cpfFornecedores;
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use (
            $nomeA,
            $cpfA,
            $TipoPessoa,
            $administrator
        ) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/providers#/')
                ->assertSee('Novo')
                ->press('#novo')
                ->type('#name', $nomeA)
                ->select('#type', $TipoPessoa)
                ->type('#cpf_cnpj', $cpfA)
                ->press('Gravar')
                ->assertSee($cpfA);
        });
    }

    public function testInsertCNPJ()
    {
        $this->createAdministrator();
        $this->init();
        $TipoPessoa = 'PJ';
        $nomeA = static::$nomeFornecedores;
        $cnpjA = static::$cnpjFornecedores;
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use (
            $nomeA,
            $cnpjA,
            $TipoPessoa,
            $administrator
        ) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/providers#/')
                ->assertSee('Novo')
                ->press('#novo')
                ->type('#name', $nomeA)
                ->select('#type', $TipoPessoa)
                ->type('#cpf_cnpj', $cnpjA)
                ->press('Gravar')
                ->assertSee($nomeA)
                ->assertSee($cnpjA);
        });
    }

    public function testValidation()
    {
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use ($administrator) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/providers#/')
                ->clickLink('Novo')
                ->press('Gravar')
                ->assertSee('O CNPJ não é válido.')
                ->assertSee('O campo Tipo pessoa (PJ ou PF) é obrigatório.')
                ->assertSee('O campo nome é obrigatório.');
        });
    }

    public function testAlter()
    {
        $this->init();
        $nomeA = static::$nomeFornecedores;
        $randomProviders1 = static::$randomProviders;
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use (
            $nomeA,
            $randomProviders1,
            $administrator
        ) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/entry-types/' . $randomProviders1['id'] . '#/')
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
                ->visit('admin/providers#/')
                ->type('@search-input', '1323e12312vcxvdsf413543445654')
                ->click('@search-button')
                ->waitForText('Nenhum Fornecedor ou Favorecido encontrado')
                ->screenshot('Providers-wrongsearch')
                ->assertSee('Nenhum Fornecedor ou Favorecido encontrado');
        });
    }

    public function testRightSearch()
    {
        $this->init();
        $randomProviders1 = static::$randomProviders;
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use (
            $administrator,
            $randomProviders1
        ) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/providers#/')
                ->type('@search-input', $randomProviders1['name'])
                ->click('@search-button')
                ->assertSee($randomProviders1['cpf_cnpj'])
                ->assertSee($randomProviders1['type'])
                ->screenshot('Providers-rightsearch');
        });
    }
    public function testCancellation()
    {
        $administrator = static::$administrator;

        $this->browse(function (Browser $browser) use ($administrator) {
            $browser
                ->loginAs($administrator['id'])
                ->visit('admin/providers#/')
                ->clickLink('Novo')
                ->press('#cancelButton')
                ->assertSee('Fornecedores / Favorecidos');
        });
    }
}
