<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPostulacion extends Model
{
    protected $table = 'estado_postulacion';
    public $timestamps = false;

    protected $fillable = ['nombre_estado'];
}
