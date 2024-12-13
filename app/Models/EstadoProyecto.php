<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EstadoProyecto extends Model
{
    protected $table = 'estado_por_proyecto';

    public function tipoEstado(): HasOne
    {
        return $this->hasOne(TipoEstadoProyecto::class);
    }
}
