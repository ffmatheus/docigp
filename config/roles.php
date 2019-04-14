<?php

return [
    'grants' => [
        ['group' => 'administrator', 'abilities' => ['*']],

        [
            'group' => 'congressman',

            'abilities' => [
                'assign:chief',
                'assign:manager',
                'assign:advisor',
                'assign:operator',
                'assign:verifier',
                'congressman:show',
                'congressman-budgets:show',
                'congressman-budgets:create',
                'congressman-budgets:update',
                'congressman-budgets:percentage',
                'entries:show',
                'entries:verify',
                'entries:update',
                'entries:publish',
                'entries:delete',
                'entry-documents:show',
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
                'congressman-budgets:create',
                'congressman-budgets:update',
                'congressman-budgets:publish',
                'congressman-budgets:deposit',
                'congressman-budgets:analyse',
                'entries:show',
                'entries:analyse',
                'entry-documents:show',
                'entry-documents:analyse',
            ],
        ],
    ],

    'abilities' => [
        [
            'ability' => '*',
            'title' => 'PODE TUDO',
        ],

        [
            'ability' => 'assign:chief',
            'title' => 'Atribuir perfil de Chefe',
        ],
        [
            'ability' => 'assign:manager',
            'title' => 'Atribuir perfil de Gestor',
        ],
        [
            'ability' => 'assign:advisor',
            'title' => 'Atribuir perfil de Assessor',
        ],
        [
            'ability' => 'assign:operator',
            'title' => 'Atribuir perfil de Deputado',
        ],
        [
            'ability' => 'assign:verifier',
            'title' => 'Atribuir perfil de Verificador',
        ],

        [
            'ability' => 'assign:assistant',
            'title' => 'Atribuir perfil de Assistente',
        ],
        [
            'ability' => 'assign:manager',
            'title' => 'Atribuir perfil de Gestor',
        ],
        [
            'ability' => 'assign:employee',
            'title' => 'Atribuir perfil de Funcinário',
        ],
        [
            'ability' => 'assign:publisher',
            'title' => 'Atribuir perfil de Publicador',
        ],
        [
            'ability' => 'assign:viewer',
            'title' => 'Atribuir perfil de Visualizador',
        ],

        [
            'ability' => 'congressman-budgets:show',
            'title' => 'Orçamento de Deputado: ver',
        ],
        [
            'ability' => 'congressman-budgets:create',
            'title' => 'Orçamento de Deputado: criar',
        ],
        [
            'ability' => 'congressman-budgets:update',
            'title' => 'Orçamento de Deputado: alterar',
        ],
        [
            'ability' => 'congressman-budgets:publish',
            'title' => 'Orçamento de Deputado: publicar',
        ],
        [
            'ability' => 'congressman:show',
            'title' => 'Deputados: ver',
        ],
        [
            'ability' => 'congressman-budgets:deposit',
            'title' => 'Orçamento de Deputado: depositar',
        ],
        [
            'ability' => 'congressman-budgets:analyse',
            'title' => 'Orçamento de Deputado: analisar',
        ],
    ],

    'roles' => [
        [
            'title' => 'Administrator',
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
