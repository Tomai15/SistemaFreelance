<?php

namespace App\Models;

use App\Models\Urgencia;
use App\Models\Confidencialidad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    public $timestamps = false;

    protected $fillable = 
    [
        'nombre_proyecto',
        'descripcion',
        'url_documento_requerimientos',
        'horas_estimadas',
        'precio',
        'urgencia_id',
        'confidencialidad_id',
        'calificacion_trabajo',
        'perfil_desarrollador_id'
    ];
    public function urgenciaEstablecida(): HasOne
    {
        return $this->hasOne(Urgencia::class, 'id', 'urgencia_id');
    }
    public function confidencialidadEstablecida(): HasOne
    {
        return $this->hasOne(Confidencialidad::class, 'id', 'confidencialidad_id');
    }
    public function tecnologias(): BelongsToMany
    {
        return $this->belongsToMany(Tecnologia::class,'tecnologia_por_proyecto', 'proyecto_id', 'tecnologia_id');
    }

    public function estadosPorProyecto(): HasMany
    {
        return $this->hasMany(EstadoPorProyecto::class, 'proyecto_id');
    }

    public function estadoActual(): HasOne
    {
        return $this->hasOne(EstadoPorProyecto::class, 'proyecto_id')->latestOfMany('created_at');
    }

    public function tagsBusqueda(): BelongsToMany
    {
        return $this->belongsToMany(TagBusqueda::class,'tag_por_proyecto');
    }

    public function postulaciones(): HasMany
    {
        return $this->hasMany(Postulacion::class, 'proyecto_id');
    }

    public function desarrolladorSeleccionado(): HasOne
    {
        return $this->hasOne(PerfilDesarrollador::class, 'id', 'perfil_desarrollador_id');
    }
}
