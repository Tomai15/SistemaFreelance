<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urgencia extends Model
{
    protected $table = 'urgencia';
    protected $fillable = ['nivel_urgencia'];
}
