<?php

namespace App\Models;

use PDO;
use PDOException;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    private $pdo;

    public function __construct($host, $port, $dbname, $username, $password)
    {
        try {
            $capsule = new Capsule();

            $capsule->addConnection([
                "driver" => "mysql",
                "host" => "$host",
                "database" => $dbname,
                "username" => $username,
                "password" => $password,
                "charset" => "utf8",
                "collation" => "utf8_unicode_ci",
                "prefix" => "",
            ]);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            error_log("Coneccion exitosa");
        } catch (\Exception $e) {
            die("Error al conectar: " . $e->getMessage());
        }
    }

    
}
