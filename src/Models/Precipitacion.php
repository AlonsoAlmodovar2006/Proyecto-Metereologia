<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precipitacion extends Model
{
    protected $table = 'precipitacion';

    protected $primaryKey = 'fecha';

    public $timestamps = false;

    protected $fillable = ['fecha', 'mmacumulado'];
}
