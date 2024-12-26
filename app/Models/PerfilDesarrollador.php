<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerfilDesarrollador extends Model
{
    protected $table = 'perfil_desarrollador';
    public $timestamps = false;
    protected $fillable = 
    [
        'promedio_calificacion',
        'nombre',
        'apellido'

    ];

    public function trabajosRealizados(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    public function trabajosEnProceso(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }
    public function tecnologiasConocidas(): HasMany
    {
        return $this->hasMany(TecnologiaConocida::class);
    }


    //Version usando TecnologiaConocida como tabla intermedia

    /*
    public function tecnologiasConocidas(): BelongsToMany
    {
        return $this->belongsToMany(Tecnologia::class,'tecnlogia_por_desarrollador')
        ->using(TecnologiaConocida::class);
    }
    */
}
