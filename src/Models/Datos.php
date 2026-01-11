<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    protected $table = 'datos';

    protected $primaryKey = 'fechaSistema';

    public $timestamps = false;

    protected $fillable = ['fechaSistema', 'temperatura', 'presion', 'humedad', 'viento', 'lluvia'];
    protected $casts = [
        'fechaSistema' => 'datetime', 
    ];
}