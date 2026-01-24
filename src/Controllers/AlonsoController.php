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

    public function recibirDatos()
    {
        if (isset($_GET['temp'], $_GET['pres'], $_GET['hum'], $_GET['viento'], $_GET['lluvia'])) {
            if (is_numeric($_GET['temp']) && is_numeric($_GET['pres']) && is_numeric($_GET['hum']) && is_numeric($_GET['viento']) && is_numeric($_GET['lluvia'])) {
                $this->myModel->insertarFila($_GET['temp'], $_GET['pres'], $_GET['hum'], $_GET['viento'], $_GET['lluvia']);
            } else {
                http_response_code(400);
                echo "Parámetros no válidos";
            }
        } else {
            http_response_code(400);
            echo "Faltan parámetros";
        }
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

        echo $this->twig->render("viento.html.twig", compact("datos"));
    }
}
