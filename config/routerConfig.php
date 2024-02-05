<?php

use App\Controller\UserController;
use App\Controller\PostController;

// Definición de rutas
return [
    '/' => [
        'controller' => UserController::class,
        'method' => 'index'
    ],
    '/about' => [
        'controller' => UserController::class,
        'method' => 'about'
    ],
    '/admin' => [
        'controller' => UserController::class,
        'method' => 'login'
    ],
    '/logout' => [
        'controller' => UserController::class,
        'method' => 'logout'
    ],
    '/post/detail/:id' => [
        'controller' => UserController::class,
        'method' => 'post'
    ],
    '/post/new' => [
        'controller' => PostController::class,
        'method' => 'new'
    ],
    '/post/edit/:id' => [
        'controller' => PostController::class,
        'method' => 'edit'
    ],
    '/post/delete/:id' => [
        'controller' => PostController::class,
        'method' => 'delete'
    ]
];
