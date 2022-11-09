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
        'production' => [
            'adapter' => 'sqlite',
            'name' => 'phpnotifier',
            'suffix' => '.db'
        ],
        'development' => [
            'adapter' => 'sqlite',
            'name' => 'phpnotifier',
            'suffix' => '.db'
        ]
    ],
    'version_order' => 'creation'
];
