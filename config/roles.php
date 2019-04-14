<?php

return [
    'grants' => [
        [
            'group' => 'administrator',
            'abilities' => ['*' => 'PODE FAZER TUDO'],
        ],

        [
            'group' => 'congressman',

            'abilities' => [
                'assign:chief' => 'Atribuir perfil de Chefe',
                'assign:manager' => 'Atribuir perfil de Gestor',
                'assign:advisor' => 'Atribuir perfil de Assessor',
                'assign:operator' => 'Atribuir perfil de Lançador',
                'assign:congressman' => 'Atribuir perfil de Deputado',
                'assign:verifier' => 'Atribuir perfil de Verificador',

                'congressman:show',
                'congressman-budgets:show' => 'Orçamento de Deputado: ver',
                'congressman-budgets:create' => 'Orçamento de Deputado: criar',
                'congressman-budgets:update' =>
                    'Orçamento de Deputado: alterar',
                'congressman-budgets:percentage' =>
                    'Orçamento de Deputado: percentual',

                'entries:show' => 'Lançamentos: ver',
                'entries:verify' => 'Lançamentos: verificar',
                'entries:update' => 'Lançamentos: alterar',
                'entries:publish' => 'Lançamentos: publicar',
                'entries:delete' => 'Lançamentos: deletar',

                'entry-documents:show' => 'Documentos: ver',
                'entry-documents:publish' => 'Documentos: publicar',
            ],
        ],

        [
            'group' => 'director',

            'abilities' => [
                'assign:assistant' => 'Atribuir perfil de Assistente',
                'assign:manager' => 'Atribuir perfil de Gestor',
                'assign:employee' => 'Atribuir perfil de Funcionário',
                'assign:publisher' => 'Atribuir perfil de Publicador',
                'assign:viewer' => 'Atribuir perfil de Visualizador',

                'congressman:show' => 'Deputados: ver',

                'congressman-budgets:show' => 'Orçamento de Deputado: ver',
                'congressman-budgets:create' => 'Orçamento de Deputado: criar',
                'congressman-budgets:update' =>
                    'Orçamento de Deputado: alterar',
                'congressman-budgets:publish' =>
                    'Orçamento de Deputado: publicar',
                'congressman-budgets:deposit' =>
                    'Orçamento de Deputado: depositar',
                'congressman-budgets:analyse' =>
                    'Orçamento de Deputado: analisar',

                'entries:show' => 'Lançamentos: ver',
                'entries:analyse' => 'Lançamentos: analisar',

                'entry-documents:show' => 'Documentos: ver',
                'entry-documents:analyse' => 'Documentos: analisar',
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
    ],
];
