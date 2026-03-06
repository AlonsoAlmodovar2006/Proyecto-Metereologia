<?php

namespace App\Controllers;

use App\Models\Database;
use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Controller
{
    private $myModel;
    private $twig;
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();
        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $this->twig = new Environment($loader);

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);

        $this->myModel = new Database(getenv("DB_HOST"), getenv("DB_PORT"), getenv("DB_DATABASE"), getenv("DB_USERNAME"), getenv("DB_PASSWORD"));
    }

    public function index()
    {        
        $datos = $this->myModel->pedirUltimas24h();
        if (!$datos) $datos = [];
        echo $this->twig->render("home.html.twig", compact("datos"));
    }
}
