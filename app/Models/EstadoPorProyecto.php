<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstadoPorProyecto extends Model
{
    protected $table = 'estado_por_proyecto';

    protected $fillable = ['proyecto_id', 'tipo_estado_id'];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(TipoEstado::class, 'tipo_estado_id');
    }
}
