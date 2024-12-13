<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEstadoProyecto extends Model
{
    protected $table = 'tipo_estado_proyecto';
    protected $fillable = ['nombre_tipo_estado'];
}
