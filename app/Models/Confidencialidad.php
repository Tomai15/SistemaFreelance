<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confidencialidad extends Model
{
    protected $table = 'confidencialidad';
    protected $fillable = ['nivel_confidencialidad'];
}