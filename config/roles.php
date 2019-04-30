<?php

use App\Support\Constants;

return [
    'grants' => [
        [
            'group' => 'administrator',

            'abilities' => [
                '*' => 'PODE FAZER TUDO',

                'assign:chief' => 'Atribuir perfil de Chefe',
                'assign:manager' => 'Atribuir perfil de Gestor',
                'assign:advisor' => 'Atribuir perfil de Assessor',
                'assign:operator' => 'Atribuir perfil de Lançador',
                'assign:congressman' => 'Atribuir perfil de Deputado',
                'assign:verifier' => 'Atribuir perfil de Verificador',

                'congressman:show' => 'Deputados: ver',
                'congressman:update' => 'Deputados: alterar',

                'congressman-budgets:show' => 'Orçamento de Deputado: ver',
                'congressman-budgets:store' => 'Orçamento de Deputado: criar',
                'congressman-budgets:update' =>
                    'Orçamento de Deputado: alterar',
                'congressman-budgets:percentage' =>
                    'Orçamento de Deputado: percentual',

                'entries:show' => 'Lançamentos: ver',
                'entries:verify' => 'Lançamentos: verificar',
                'entries:store' => 'Lançamentos: criar',
                'entries:update' => 'Lançamentos: alterar',
                'entries:publish' => 'Lançamentos: publicar',
                'entries:delete' => 'Lançamentos: deletar',
                'entries:control-update' =>
                    'Lançamentos: alterar lançamento de controle',

                'entry-documents:show' => 'Documentos: ver',
                'entry-documents:store' => 'Documentos: criar',
                'entry-documents:publish' => 'Documentos: publicar',
                'assign:assistant' => 'Atribuir perfil de Assistente',
                'assign:employee' => 'Atribuir perfil de Funcionário',
                'assign:publisher' => 'Atribuir perfil de Publicador',
                'assign:viewer' => 'Atribuir perfil de Visualizador',

                'congressman-budgets:publish' =>
                    'Orçamento de Deputado: publicar',
                'congressman-budgets:deposit' =>
                    'Orçamento de Deputado: depositar',
                'congressman-budgets:analyse' =>
                    'Orçamento de Deputado: analisar',

                'entries:analyse' => 'Lançamentos: analisar',

                'entry-documents:analyse' => 'Documentos: analisar',
                'assign:financier' => 'Atribuir perfil de Financeiro',

                'users:show' => 'Usuários: ver',
                'users:store' => 'Usuários: criar',
                'users:update' => 'Usuários: alterar',

                'providers:show' => 'Fornecedores: ver',
                'providers:store' => 'Fornecedores: criar',
                'providers:update' => 'Fornecedores: alterar',

                'cost-centers:show' => 'Centros de custo: ver',
                'cost-centers:store' => 'Centros de custo: criar',
                'cost-centers:update' => 'Centros de custo: alterar',
            ],
        ],

        [
            'group' => Constants::ROLE_CONGRESSMAN,

            'abilities' => [
                'assign:chief',
                'assign:manager',
                'assign:advisor',
                'assign:operator',
                'assign:congressman',
                'assign:verifier',

                'congressman:show',
                'congressman-budgets:show',
                'congressman-budgets:store',
                'congressman-budgets:update',
                'congressman-budgets:percentage',

                'entries:show',
                'entries:verify',
                'entries:store',
                'entries:update',
                'entries:publish',
                'entries:delete',

                'entry-documents:show',
                'entry-documents:store',
                'entry-documents:publish',
            ],
        ],

        [
            'group' => 'director',

            'abilities' => [
                'assign:assistant',
                'assign:manager',
                'assign:employee',
                'assign:publisher',
                'assign:viewer',
                'congressman:show',
                'congressman-budgets:show',
                'congressman-budgets:store',
                'congressman-budgets:update',
                'congressman-budgets:publish',
                'congressman-budgets:analyse',
                'entries:show',
                'entries:analyse',
                'entries:control-update',
                'entries:update',
                'entries:delete',
                'entry-documents:show',
                'entry-documents:analyse',
            ],
        ],
        [
            'group' => 'financial',

            'abilities' => [
                'assign:financier',

                'congressman:show',

                'congressman-budgets:show',
                'congressman-budgets:deposit',

                'entries:show',

                'entry-documents:show',
            ],
        ],
    ],

    'roles' => [
        [
            'title' => 'Administrador',
            'name' => 'administrator',
        ],
        [
            'title' => 'Deputado',
            'name' => 'congressman',
        ],
        [
            'title' => 'Chefe',
            'name' => 'chief',
        ],
        [
            'title' => 'Gestor',
            'name' => 'manager',
        ],
        [
            'title' => 'Assessor',
            'name' => 'advisor',
        ],
        [
            'title' => 'Operador',
            'name' => 'operator',
        ],
        [
            'title' => 'Verificador',
            'name' => 'verifier',
        ],
        [
            'title' => 'Diretor',
            'name' => 'director',
        ],
        [
            'title' => 'Assistente',
            'name' => 'assistant',
        ],
        [
            'title' => 'Gestor',
            'name' => 'manager',
        ],
        [
            'title' => 'Funcionário',
            'name' => 'employee',
        ],
        [
            'title' => 'Publicador',
            'name' => 'publisher',
        ],
        [
            'title' => 'Visualizador',
            'name' => 'viewer',
        ],
        [
            'title' => 'Financeiro',
            'name' => 'financier',
        ],
    ],
];
