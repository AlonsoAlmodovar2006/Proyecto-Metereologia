<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Datos1 extends Model
{
    protected $table = 'datos1';

    protected $primaryKey = 'fechaSistema';

    public $timestamps = false;

    protected $fillable = ['fechaSistema', 'temperatura', 'presion', 'humedad', 'intUltravioleta'];
}
