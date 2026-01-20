<?php

namespace App\Controllers;

use App\Models\Database;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AlonsoController extends Controller
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

    public function dividirRuta($data)
    {
        $datos = $data;
        include __DIR__ . "/../Views/probandoDatos.html";
    }

    public function lanzarProyectoAnterior()
    {
        echo $this->twig->render("proyectoAnterior.html.twig");
    }
}
