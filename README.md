# DOCIGP - Descentralização Orçamentária de Custeio Individualizado para Gabinete Parlamentar 

## [https://docigp.alerj.rj.gov.br/](https://docigp.alerj.rj.gov.br/)

## Características da aplicação

- [Git](https://git-scm.com/docs/user-manual.html)
- [PHP 7.2 ou superior](http://php.net/)
- [Composer](https://getcomposer.org/)
- [Redis](https://redis.io/topics/quickstart)
- [PostgreSQL](https://www.postgresql.org/)

### Instalação 

#### Guia genérico de uma aplicação desenvolvida em PHP pelo Projetos Especiais

- Clonar o repositório (branch: staging [homologação] or production [produção])
- Configurar servidor web para apontar para a **`<pasta-aonde-o-site-foi-instalado>`/public**
- Instalar certificado SSL (precisamos que a página seja acessível **via https apenas**)
- Criar o banco do dados
- Entrar na `<pasta-aonde-o-site-foi-instalado>`
- Copiar o arquivo `.env.example` para `.env`
- Editar o arquivo `.env` e configurar todos dados do sistema
- Ainda no arquivo `.env`, alterar a variável `APP_ENV` para o ambiente correto (testing, staging, production)
- Ainda no arquivo `.env`, configurar banco de dados
- Executar o comando `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev` para instalar todas as dependências da aplicação
- Banco de dados
    - Caso **não** haja backup: executar o comando `php artisan migrate` para **criar** a estrutura do banco de dados
    - Caso haja backup: restaurar o banco e executar o comando `php artisan migrate` para **atualizar** a estrutura do banco de dados

### Atualizando a aplicação

- Entrar na `<pasta-aonde-o-site-foi-instalado>`
- Baixar as atualizações de código fonte usando Git (git pull ou git fetch + git merge, isso depende de como operador prefere trabalhar com Git)
- Executar o comando `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev` para instalar todas as dependências (atualizadas)
- Executar os comandos:
```
php artisan migrate
php artisan docigp:sync:roles
php artisan storage:link
```

#### Passos extras específicos desta aplicação

##### Configurar [scheduler](https://laravel.com/docs/5.8/scheduling)
Colocar no cron a seguinte linha de comando, respeitando o path da aplicação:
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

##### Configurar o [Laravel Horizon](https://laravel.com/docs/5.8/horizon)
Configurar o Supervisor para manter o Horizon rodando o seguinte deamon
```
php artisan horizon
```

##### Configurar [Pusher](https://pusher.com/)
As configurações ficam no .env:

```
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

### Comandos disponíveis

```
alias a="php artisan"

a docigp:sync:parties 
a docigp:sync:congressmen
a docigp:sync:departments
a docigp:sync:roles
a docigp:budget:generate
a docigp:role:assign administrator afaria@alerj.rj.gov.br 
a storage:link
```

### Para debugar
 
```
- Budget de Fevereiro e Março
a migrate:fresh -vvv --force; a docigp:sync:parties -vvv; a docigp:sync:congressmen -vvv; a docigp:sync:departments; a docigp:sync:roles; a docigp:budget:generate 2019-02-01; a docigp:budget:generate 2019-03-01;                                a db:seed -vvv --force; a docigp:budget:generate -vvv; 
- Budget de Fevereiro, Março e Abril
a migrate:fresh -vvv --force; a docigp:sync:parties -vvv; a docigp:sync:congressmen -vvv; a docigp:sync:departments; a docigp:sync:roles; a docigp:budget:generate 2019-02-01; a docigp:budget:generate 2019-03-01; a docigp:budget:generate -vvv; a db:seed -vvv --force;

a migrate:fresh -vvv --force; a docigp:sync:roles -vvv; a docigp:budget:generate 2019-04-01 -vvv; a docigp:budget:generate -vvv
```



### Permissões

```
Deputado (lançar / verificar / verificar o próprio lançamento / criar usuário)
Chefe (lançar / verificar / verificar o próprio lançamento / criar usuário)
Gestor (lançar / verificar / criar usuário)
Assessor (visualizar)
Lançador (lançar / editar)
Verificador (verificar)

Diretor (associar perfil de deputado / autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)
Financeiro (depositar)
Assistente (autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)
Gestor (autorizar / publicar / criar usuário)
Funcionário (visualizar)
Autorizador (autorizar)
Publicador (publicar)
```
