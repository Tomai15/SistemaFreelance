<?php

namespace App\Models;

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
        'nivel_urgencia',
        'calificacion_trabajo'
    ];
    public function casts(): array
    {
        return ['nivel_urgencia' => Urgencia::class, 'nivel_confidencialidad' => Confidencialidad::class];
    }
    public function tecnologias(): BelongsToMany
    {
        return $this->belongsToMany(Tecnologia::class,'tecnologia_por_proyecto');
    }

    public function estadosProyecto(): HasMany
    {
        return $this->hasMany(EstadoProyecto::class);
    }

    public function estadoActual(): HasOne
    {
        return $this->estadosProyecto()->one()->latestOfMany();
    }

    public function tagsBusqueda(): BelongsToMany
    {
        return $this->belongsToMany(TagBusqueda::class,'tag_por_proyecto');
    }

    public function postulantes(): BelongsToMany
    {
        return $this->belongsToMany(PerfilDesarrollador::class,'postulante_por_proyecto');
    }

    public function desarrolladorSeleccionado(): HasOne
    {
        return $this->hasOne(PerfilDesarrollador::class);
    }



    
}
