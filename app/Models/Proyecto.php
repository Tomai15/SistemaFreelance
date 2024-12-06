<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    public $timestamps = false;

    public function tecnologias(): HasMany
    {
        return $this->hasMany(Tecnologia::class);
    }
    public function estadosProyecto(): HasMany
    {
        return $this->hasMany(EstadoProyecto::class);
    }
    public function tagsBusqueda(): HasMany
    {
        return $this->hasMany(TagBusqueda::class);
    }

    
}
