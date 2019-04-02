### Comandos

docigp:sync:parties
docigp:sync:congressmen
docigp:budget:generate

a migrate:fresh -vvv; a docigp:sync:parties -vvv; a docigp:sync:congressmen -vvv; a docigp:budget:generate -vvv; a db:seed -vvv

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
