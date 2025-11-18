<?php

namespace App\Routes;

class Router
{
    private $routes = [];

    public function __construct()
    {
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        $this->routes["/"] = ["controller" => "Controller", "action" => "index"];
    }


    public function handleRequest()
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); //Para recordar.

        if ($this->routes[$path]) {
            $route = $this->routes[$path];
            $controllerClass = "\\App\\Controllers\\" . $route["controller"];
            $action = $route["action"];
            if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
                $controller = new $controllerClass();
                $controller->$action($_REQUEST);
            } else {
                echo "Error 404 1";
            }
        } else {
            echo "Error 404 0";
        }
    }
}

$router = new Router();

$router->handleRequest();
