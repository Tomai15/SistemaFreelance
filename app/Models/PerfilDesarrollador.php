<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerfilDesarrollador extends Model
{
    protected $table = 'perfil_desarrollador';
    
    protected $fillable = 
    [
        'promedio_calificacion',
        'nombre',
        'apellido',
        

    ];

    public function trabajosRealizados(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    public function trabajosEnProceso(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    public function tecnologiasConocidas(): BelongsToMany
    {
        return $this->belongsToMany(Tecnologia::class,'tecnlogia_por_desarrollador')
        ->using(TecnologiaConocida::class);
    }
}
