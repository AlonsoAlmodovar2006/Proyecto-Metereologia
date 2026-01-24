<?php

namespace App\Controllers;

use App\Models\Database;
use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;


class MCarmenController
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

    public function index() {}

    

    public function temperatura(){

        $fechaInicio=filter_input(INPUT_POST,'inicio',FILTER_SANITIZE_SPECIAL_CHARS);

        $fechaFin=filter_input(INPUT_POST,'final',FILTER_SANITIZE_SPECIAL_CHARS);

        $datos=null;

        if(!empty($fechaInicio) && !empty($fechaFin)){
            $datos=$this->myModel->obtenerTemperaturaPorFecha($fechaInicio,$fechaFin);
        }else{
            $datos=$this->myModel->obtenerTemperatura();
        }
        
        error_log("sale o no".$datos);
        echo $this->twig->render("temperatura.html.twig",compact("datos"));
    }

    

}
