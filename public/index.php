<?php

declare(strict_types=1);

use App\Library\Router;
use App\Library\Container;
use App\Library\Config;
use App\Library\View;
use App\Library\Auth;
use App\Library\Database;
use App\Model\User;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));

try {

    // Load the autoloader from third-party libraries
    require_once BASE_PATH . '/vendor/autoload.php';

    $setting_params = include_once BASE_PATH . '/config/appConfig.php';
    $routes = include_once BASE_PATH . '/config/routerConfig.php';
    $container = new Container();

    $container->bind(Config::class, function () use ($setting_params) {
        return new Config($setting_params);
    });

    $container->bind(View::class, function () use ($container) {
        $view = new View();
        $view->setContainer($container);
        return $view;
    });

    $container->bind(Database::class, function () use ($setting_params) {
        $db = Database::getInstance($setting_params['database']['driver'], $setting_params['database']['host'], $setting_params['database']['database'], $setting_params['database']['username'], $setting_params['database']['password']);
        return $db->connect();
    });

    $container->bind(Auth::class, function () use ($container) {
        $user = new User($container);
        $auth = new Auth($user);
        return $auth;
    });

    $router = new Router();
    if (!empty($routes)) {
        foreach ($routes as $key => $value) {
            $router->addRoute($key, $value['controller'], $value['method'], $container);
        }
    }

    // Añadir eventos
    $router->addEventListener('before', function ($data) {
        // Código que se ejecuta antes de procesar la ruta
        $container = $data['container'];
        $auth = $container->make(Auth::class);
        if ($data['controller'] === 'App\Controller\PostController' && !$auth->isUserAuthenticated()) {
            header("Location: /admin");
            exit();
        }
    });

    // Ejecuta el enrutador
    $router->run();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
