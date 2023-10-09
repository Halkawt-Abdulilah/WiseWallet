<?php

namespace Wisewallet\Config;

use Exception;

class Router
{

    private $routes;

    function __construct()
    {
        $this->routes = [];
    }

    public function get($route, $action)
    {
        $this->addRoute($route, $action, 'get');
    }
    public function post($route, $action)
    {
        $this->addRoute($route, $action, 'post');
    }

    public function addRoute($route, $action, $method)
    {
        $this->routes[$method][$route] = $action;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getRoute()
    {
        // you can improve this method for robust route parsing.
        //not production routing 
        $uri = array_slice(explode('/', $_SERVER['REQUEST_URI']), 1);
        $target = [$uri[count($uri) - 2], $uri[count($uri) - 1]];
        if ($target[0] == "iminstance") {
            $target = "/" . $target[1];
        } else {
            $target = "/" . $target[0] . "/" . $target[1];
        }
        return $target;
    }

    public function dispatch()
    {

        $route = $this->getRoute();
        $method = $this->getMethod();
        $action = $this->routes[$method][$route] ?? false;

        if ($action === false) {
            throw new Exception('Route not found');
        }

        if (is_callable($action)) {
            $action();
        }
        if (is_array($action)) {
            $controller = new $action[0]();
            $method = $action[1];
            $controller->$method();
        }
    }
}

?>