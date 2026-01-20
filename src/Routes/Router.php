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
        $this->routes["/temperatura"]=["controller"=>"MCarmenController","action"=>"temperatura"];
        $this->routes['/datos'] = ["controller" => "AlonsoController", "action" => "dividirRuta"];
        $this->routes["/ultimas24h"] = ["controller" => "OrwinController", "action" => "obtenerDatosUltimas24h"];
        $this->routes["/presion"] = ["controller" => "OrwinController", "action" => "obtenerDatosPresion"];
        $this->routes["/humedad"] = ["controller" => "OrwinController", "action" => "obtenerDatosHumedad"];
        $this->routes["/viento"] = ["controller" => "AlonsoController", "action" => "obtenerDatosViento"];
        $this->routes["/lluvia"] = ["controller" => "x", "action" => "x"];
        $this->routes["/proyectoAnterior"] = ["controller" => "AlonsoController", "action" => "lanzarProyectoAnterior"];

    }

    public function handleRequest()
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); 

        if ($this->routes[$path]) {
            $route = $this->routes[$path];
            $controllerClass = "\\App\\Controllers\\" . $route["controller"];
            $action = $route["action"];
            if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
                $controller = new $controllerClass();
                $controller->$action($_REQUEST);
            } else {
                echo "Error 404 1: No se encuentra la clase <b>$controllerClass</b> o el método <b>$action</b>";
            }
        } else {
            echo "Error 404 0";
        }
    }
}

$router = new Router();

$router->handleRequest();
