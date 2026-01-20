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

    public function obtenerDatosViento()
    {
        $inicio = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $final = filter_input(INPUT_POST, 'final', FILTER_SANITIZE_SPECIAL_CHARS);

        $datos = null;

        if ($inicio == "") $inicio = null;
        if ($final == "") $final = null;

        if ($inicio || $final) {
            $datos = $this->myModel->pedirDatosVientoEntre($inicio, $final);
        } else {
            $datos = $this->myModel->pedirDatosViento();
        }

        error_log($datos);
        echo $this->twig->render("viento.html.twig", compact("datos"));
    }
}
