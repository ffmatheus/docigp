<?php

return [
    'abilities' => [
        ['group' => 'administrator', 'ability' => 'everything'],

        ['group' => 'congressman', 'ability' => 'assign:chief'],
        ['group' => 'congressman', 'ability' => 'assign:manager'],
        ['group' => 'congressman', 'ability' => 'assign:advisor'],
        ['group' => 'congressman', 'ability' => 'assign:operator'],
        ['group' => 'congressman', 'ability' => 'assign:verifier'],

        ['group' => 'director', 'ability' => 'assign:assistant'],
        ['group' => 'director', 'ability' => 'assign:manager'],
        ['group' => 'director', 'ability' => 'assign:employee'],
        ['group' => 'director', 'ability' => 'assign:publisher'],
        ['group' => 'director', 'ability' => 'assign:viewer'],
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
