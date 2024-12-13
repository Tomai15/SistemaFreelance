<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TecnologiaConocida extends Model
{
    protected $table = 'tecnologia_por_desarrollador';
    protected $fillable = ['nivel_tecnologia'];
}
