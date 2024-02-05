<?php

return [
    'database' =>  [
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'blog',
        'port' => 3306 // El puerto por defecto de MySQL es 3306
    ],
    'application' => [
        'path_controller' => BASE_PATH . '/src/controller',
        'path_view' => BASE_PATH . '/src/view',
        'path_model' => BASE_PATH . '/src/model'
    ]
];
