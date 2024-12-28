<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEstado extends Model
{
    protected $table = 'tipo_estado';
    protected $fillable = ['nombre_tipo_estado'];
}
