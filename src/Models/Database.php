<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Datos1;
use App\Models\Precipitacion;

class Database
{
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

    public function listarPrecipitacion()
    {
        return Precipitacion::all();
    }

    public function insertarPresipitacion(){
        
    }
}
