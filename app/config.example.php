<?php

return [
    'db' => [
        'host' => 'db',
        'username' => 'randomizer',
        'password' => 'password',
        'database' => 'randomizer',
        'port' => 3306,
    ],
    'routes' => [
        '/' => [\App\Controller\MainController::class, 'index'],
        '/generate' => \App\Controller\GenerateController::class,
    ]
];
