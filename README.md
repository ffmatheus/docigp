Systems
	id
	name

Departments (Diretoria Geral / CI / Deputado Fulano / Deputado Cicrano)
	id
	client_id
	name

Users
	id
	email
	name
	department_id

User Departments
	user_id
	department_id



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

Diretor (autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)
Assistente (autorizar / publicar / publicar o que foi autorizado por ele / criar usuário)
Gestor (autorizar / publicar / criar usuário)
Funcionário (visualizar)
Autorizador (autorizar)
Publicador (publicar)
