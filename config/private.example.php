<?php

return [
    'base_url' => 'http://loo.dev/',
    'development_environment' => true,

    'db_connection' => [
        'driver' => 'pdo_pgsql',
        'dbname' => 'docker',
        'user' => 'docker',
        'password' => 'docker',
        'host' => 'localhost',
    ],
];
