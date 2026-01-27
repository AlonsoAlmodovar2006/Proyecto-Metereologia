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

    public function insertarFila($temperatura, $presion, $humedad, $viento, $lluvia)
    {
        try {
            Datos::create([
                'temperatura' => $temperatura,
                'presion'     => $presion,
                'humedad'     => $humedad,
                'viento'      => $viento,
                'lluvia'      => $lluvia,
            ]);
            http_response_code(200);
            echo "OK";
        } catch (\Exception $e) {
            http_response_code(500);
            echo "Error al guardar datos";
            error_log($e->getMessage());
        }
    }

    public function obtenerTemperatura()
    {
        return Datos::select("fechaSistema", "temperatura")->get();
    }

    public function obtenerTemperaturaPorFecha($fechaInicio,$fechaFinal){
        if(isset($fechaInicio) && isset($fechaFinal)){
            return Datos::whereBetween("fechaSistema", [$fechaInicio, $fechaFinal])->get();
        }else if(isset($fechaInicio)){
            return Datos::where("fechaSistema", ">", $fechaInicio)->get();
        }else{
            return Datos::where("fechaSistema", "<", $fechaFinal)->get();
        }
    }

    public function obtenerLluvia()
    {
        return Datos::select("fechaSistema", "lluvia")->get();
    }

    public function obtenerLluviaPorFecha($fechaInicio,$fechaFinal){
        if(isset($fechaInicio) && isset($fechaFinal)){
            return Datos::whereBetween("fechaSistema", [$fechaInicio, $fechaFinal])->get();
        }else if(isset($fechaInicio)){
            return Datos::where("fechaSistema", ">", $fechaInicio)->get();
        }else{
            return Datos::where("fechaSistema", "<", $fechaFinal)->get();
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

    public function pedirDatosPresion()
    {
        return Datos::select("fechaSistema", "presion")->get();
    }


    public function pedirDatosPresionEntre($inicio, $final)
    {
        if (isset($inicio) && isset($final)) {
            return Datos::whereBetween("fechaSistema", [$inicio, $final])->get();
        } elseif (isset($inicio)) {
            return Datos::where("fechaSistema", ">", $inicio)->get();
        } elseif (isset($final)) {
            return Datos::where("fechaSistema", "<", $final)->get();
        }

        return Datos::select("fechaSistema", "presion")->get();
    }
    public function pedirDatosHumedad()
    {
        return Datos::select("fechaSistema", "humedad")->get();
    }

    public function pedirDatosHumedadEntre($inicio, $final)
    {
        if (isset($inicio) && isset($final)) {
            return Datos::whereBetween("fechaSistema", [$inicio, $final])->get();
        } elseif (isset($inicio)) {
            return Datos::where("fechaSistema", ">", $inicio)->get();
        } elseif (isset($final)) {
            return Datos::where("fechaSistema", "<", $final)->get();
        }

        return Datos::select("fechaSistema", "humedad")->get();
    }

    public function pedirDatosViento()
    {
        return Datos::select("fechaSistema", "viento")->get();
    }

    public function pedirDatosVientoEntre($inicio, $final)
    {
        if (isset($inicio) && isset($final)) {
            return Datos::whereBetween("fechaSistema", [$inicio, $final])->get();
        } elseif (isset($inicio)) {
            return Datos::where("fechaSistema", ">", $inicio)->get();
        } elseif (isset($final)) {
            return Datos::where("fechaSistema", "<", $final)->get();
        }

        return Datos::select("fechaSistema", "viento")->get();
    }
}
