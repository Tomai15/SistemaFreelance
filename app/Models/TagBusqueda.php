<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagBusqueda extends Model
{
    protected $table = 'tag_busqueda';
    protected $fillable = ['nombre_tag'];
}
