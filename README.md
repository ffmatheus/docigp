### Comandos


alias "a=php artisan"

-----
a docigp:sync:parties 
<br/>
a docigp:sync:congressmen 
<br/>
a docigp:budget:generate 
<br/>
<br/>


-----
##### Budget de Fevereiro e Março
a migrate:fresh -vvv --force; a docigp:sync:parties -vvv; a docigp:sync:congressmen -vvv; a docigp:budget:generate 2019-03-01; a docigp:budget:generate 2019-02-01; a db:seed -vvv --force;
##### Budge de Fevereiro, Março e Abril
a migrate:fresh -vvv --force; a docigp:sync:parties -vvv; a docigp:sync:congressmen -vvv; a docigp:budget:generate -vvv; a docigp:budget:generate 2019-03-01; a docigp:budget:generate 2019-02-01; a db:seed -vvv --force;

-----

### Permissões

SU - Bouncer::allow('root')->everything();

CI - Bouncer::allow('diretor')->to('criar_lancamento'); 
<br/>
CI - Bouncer::allow('diretor')->to('criar_usuario'); 
<br/>
CI - Bouncer::assign('diretor')->to('ze luiz'); 
<br/>

DG - Bouncer::allow('antonio')->to('autorizar'); 
<br/>
DG - Bouncer::allow('antonio')->to('criar_lancamento'); 
<br/>
CI - Bouncer::allow('orlando')->to('criar_lancamento'); 
<br/>
CI - Bouncer::allow('orlando')->to('criar_usuario'); 
<br/>

DFT - Bouncer::allow('zezinho')->to('criar_lancamento', departamento:3); 
<br/>
DFT - Bouncer::allow('zezinho')->to('criar_usuario', departamento:3); 
<br/>
DFT - Bouncer::allow('zezinho')->to('editar', lancamento:100); 
<br/>

Bouncer::is($user)->a('diretor'); 
<br/>
Bouncer::can($ability); 
<br/>
Bouncer::cannot($ability); 
<br/>
Bouncer::authorize($ability); 
<br/>

@can('criar_lancamento', departamento:3)

Deputado (lançar / verificar / verificar o próprio lançamento / criar usuário)
 <br/>
Chefe (lançar / verificar / verificar o próprio lançamento / criar usuário)
<br/>
Gestor (lançar / verificar / criar usuário)
<br/>
Assessor (visualizar)
<br/>
Lançador (lançar / editar)
<br/>
Verificador (verificar)

Diretor (associar perfil de deputado / autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)
<br/>
Assistente (autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)
<br/>
Gestor (autorizar / publicar / criar usuário)
<br/>
Funcionário (visualizar)
<br/>
Autorizador (autorizar)
<br/>
Publicador (publicar)
