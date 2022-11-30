<?php

/**
 * load the .env file
 */
Dotenv\Dotenv::createImmutable(__DIR__)->load();

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds'
    ],
    'environments' => [
        'default_migration_table' => $_ENV['DB_PREFIX'].'phinxlog',
        'default_environment' => 'testing',
        'testing' => [
            'adapter' => $_ENV['DB_TYPE'],
            'host'    => $_ENV['DB_HOSTNAME'],
            'name'    => $_ENV['DB_DATABASE'],
            'user'    => $_ENV['DB_USERNAME'],
            'pass'    => $_ENV['DB_PASSWORD'],
            'port'    => $_ENV['DB_HOSTPORT'],
            'charset' => $_ENV['DB_CHARSET'],
            'table_prefix' => $_ENV['DB_PREFIX'],
        ]
    ],
    'version_order' => 'creation'
];
