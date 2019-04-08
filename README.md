### Comandos


alias "a=php artisan"

-----
a docigp:sync:parties 

a docigp:sync:congressmen 

a docigp:budget:generate 


-----
##### Budget de Fevereiro e Março
a migrate:fresh -vvv --force; a docigp:sync:parties -vvv; a docigp:sync:congressmen -vvv; a docigp:budget:generate 2019-03-01; a docigp:budget:generate 2019-02-01; a db:seed -vvv --force;
##### Budge de Fevereiro, Março e Abril
a migrate:fresh -vvv --force; a docigp:sync:parties -vvv; a docigp:sync:congressmen -vvv; a docigp:budget:generate -vvv; a docigp:budget:generate 2019-03-01; a docigp:budget:generate 2019-02-01; a db:seed -vvv --force;

-----

### Permissões

SU - Bouncer::allow('root')->everything();

CI - Bouncer::allow('diretor')->to('criar_lancamento'); 

CI - Bouncer::allow('diretor')->to('criar_usuario'); 

CI - Bouncer::assign('diretor')->to('ze luiz'); 


DG - Bouncer::allow('antonio')->to('autorizar'); 

DG - Bouncer::allow('antonio')->to('criar_lancamento'); 

CI - Bouncer::allow('orlando')->to('criar_lancamento'); 

CI - Bouncer::allow('orlando')->to('criar_usuario'); 


DFT - Bouncer::allow('zezinho')->to('criar_lancamento', departamento:3); 

DFT - Bouncer::allow('zezinho')->to('criar_usuario', departamento:3); 

DFT - Bouncer::allow('zezinho')->to('editar', lancamento:100); 


Bouncer::is($user)->a('diretor'); 

Bouncer::can($ability); 

Bouncer::cannot($ability); 

Bouncer::authorize($ability); 


@can('criar_lancamento', departamento:3)

Deputado (lançar / verificar / verificar o próprio lançamento / criar usuário)

Chefe (lançar / verificar / verificar o próprio lançamento / criar usuário)

Gestor (lançar / verificar / criar usuário)

Assessor (visualizar)

Lançador (lançar / editar)

Verificador (verificar)

Diretor (associar perfil de deputado / autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)

Assistente (autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)

Gestor (autorizar / publicar / criar usuário)

Funcionário (visualizar)

Autorizador (autorizar)

Publicador (publicar)
