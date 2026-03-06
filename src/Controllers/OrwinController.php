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

        $this->myModel =  new Database(getenv("DB_HOST"), getenv("DB_PORT"), getenv("DB_DATABASE"), getenv("DB_USERNAME"), getenv("DB_PASSWORD"));
    }

    public function obtenerDatosPresion()
    {
        $inicio = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $final = filter_input(INPUT_POST, 'final', FILTER_SANITIZE_SPECIAL_CHARS);

        $datos = null;

        if ($inicio == "") $inicio = null;
        if ($final == "") $final = null;

        if ($inicio || $final) {

            $datos = $this->myModel->pedirDatosPresionEntre($inicio, $final);
        } else {
            $datos = $this->myModel->pedirDatosPresion();
        }

        error_log($datos);
        echo $this->twig->render("presion.html.twig", compact("datos"));
    }
    public function obtenerDatosHumedad()
    {
        $inicio = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $final = filter_input(INPUT_POST, 'final', FILTER_SANITIZE_SPECIAL_CHARS);

        $datos = null;

        if ($inicio == "") $inicio = null;
        if ($final == "") $final = null;

        if ($inicio || $final) {
            $datos = $this->myModel->pedirDatosHumedadEntre($inicio, $final);
        } else {
            $datos = $this->myModel->pedirDatosHumedad();
        }

        error_log($datos);
        echo $this->twig->render("humedad.html.twig", compact("datos"));
    }
}
