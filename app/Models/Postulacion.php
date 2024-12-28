<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulante_por_proyecto';

    protected $fillable = ['proyecto_id', 'perfil_desarrollador_id', 'estado_postulacion_id'];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function perfilDesarrollador(): BelongsTo
    {
        return $this->belongsTo(PerfilDesarrollador::class, 'perfil_desarrollador_id');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(EstadoPostulacion::class, 'estado_postulacion_id');
    }
}
