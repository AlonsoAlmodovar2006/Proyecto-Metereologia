<?php

namespace App\Controllers;

use App\Models\Database;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class OrwinController
{
    private $myModel;
    private $twig;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();

        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);

        $this->myModel = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
    }

    public function obtenerDatosUltimas24h()
    {
        $datos = $this->myModel->pedirUltimas24h();
        error_log($datos);
        echo $this->twig->render("home.html.twig", compact("datos"));
    }

    public function obtenerDatosHumedad() {
        $datos = $this->myModel->pedirDatosHumedad();
        error_log($datos);
        echo $datos;
    }
}
