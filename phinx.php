<?php

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'production',
        'production' => [
            'adapter' => getenv('DB_ADAPTER'),
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'charset' => 'utf8',
        ],
    ],
];
