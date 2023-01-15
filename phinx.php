<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'pgsql',
            'host' => '127.0.0.1',
            'name' => 'flight_notifier',
            'user' => 'postgres',
            'pass' => 'root',
            'port' => '5434',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'name' => 'testing',
            'suffix' => '.db'
        ]
    ],
    'version_order' => 'creation'
];