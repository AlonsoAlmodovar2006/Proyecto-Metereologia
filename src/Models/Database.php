<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Datos1;
use App\Models\Precipitacion;
use DateTime;
use Illuminate\Support\Facades\Date;

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

    public function pedirUltimas24h()
    {
        $fechaActual = new DateTime();
        $fecha24hAtras = new DateTime();
        $fecha24hAtras->modify("-24 hours");

        return Datos::whereBetween("fechaSistema", [$fecha24hAtras, $fechaActual])->get();
    }
}
