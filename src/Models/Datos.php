<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    protected $table = 'datos';

    protected $primaryKey = 'fechaSistema';

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['temperatura', 'presion', 'humedad', 'viento', 'lluvia'];

    protected $casts = [
        'fechaSistema' => 'datetime',
    ];
}
