<?php

namespace App\Controllers;

use App\Models\Database;
use Dotenv\Dotenv;

class Controller
{
    //Instanciar el modelo
    private $myModel;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();

        $this->myModel = new Database($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_DATABASE"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
    }

    public function index()
    {
        include __DIR__ . "/../Views/home.html";
    }
}
