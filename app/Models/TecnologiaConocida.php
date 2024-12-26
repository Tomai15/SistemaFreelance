<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TecnologiaConocida extends Model
{
    protected $table = 'tecnologia_por_desarrollador';
    public $timestamps = false;
    protected $fillable = ['nivel_tecnologia'];

    public function tecnologia (): BelongsTo
    {
        return $this->belongsTo(Tecnologia::class);
    }
}
