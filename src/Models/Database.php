<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Datos;
use App\Models\Precipitacion;
use DateTime;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

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
        error_log("==========================================");
        error_log(Carbon::parse($fecha24hAtras));

        return Datos::whereBetween("fechaSistema", [Carbon::parse($fecha24hAtras), Carbon::parse($fechaActual)])->get();
    }

    public function pedirDatosHumedad()
    {
        return Datos::select("fechaSistema","humedad")->get();
    }
}
