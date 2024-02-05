<?php

namespace App\Library;

class Router
{
    protected $routes = [];
    private $eventListeners = [];

    public function addRoute($uri, $controller, $method, $container)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method, 'container' => $container];
    }

    public function addEventListener($event, callable $listener)
    {
        $this->eventListeners[$event][] = $listener;
    }

    private function dispatchEvent($event, $data = null)
    {
        if (!empty($this->eventListeners[$event])) {
            foreach ($this->eventListeners[$event] as $listener) {
                call_user_func($listener, $data);
            }
        }
    }

    public function run()
    {
        $uri = $this->getUri();
        $match_routes = [];
        foreach ($this->routes as $route => $value) {
            $pattern = "@^" . preg_replace('/:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', $route) . "$@D";
            $params = [];
            // check if the current request params the expression
            $match = preg_match($pattern, $uri, $params);
            if ($match) {
                array_shift($params);
                $match_routes[] = ['controller' => $value['controller'], 'method' => $value['method'], 'container' => $value['container'], 'params' => $params];
            } else if ($uri === $route) {
                $match_routes[] = ['controller' => $value['controller'], 'method' => $value['method'], 'container' => $value['container'], 'params' => null];
            }
        }
        if (!empty($match_routes)) {
            $this->dispatchEvent('before', $match_routes[0]);
            if (!$this->callMethod($match_routes[0]['controller'], $match_routes[0]['method'], $match_routes[0]['container'], $match_routes[0]['params'])) {
                $this->sendNotFound($uri);
            }
            $this->dispatchEvent('after', $match_routes[0]);
        } else {
            $this->sendNotFound($uri);
        }
    }

    private function callMethod($controller, $method, $container, $params = null)
    {
        if (class_exists($controller) && method_exists($controller, $method)) {
            $controllerObject = new $controller($container);
            $controllerObject->$method($params);
            return true;
        }
        return false;
    }

    protected function getUri()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    protected function sendNotFound($uri)
    {
        $this->dispatchEvent('notFound', $uri);
        header("HTTP/1.1 404 Not Found");
        echo '404 Not Found';
    }
}
