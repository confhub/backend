<?php

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'production',
        'production' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'default',
            'user' => 'root',
            'pass' => 'password',
            'port' => '3306',
            'charset' => 'utf8',
        ],
    ],
];
