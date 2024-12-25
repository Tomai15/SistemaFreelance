<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';
    public $timestamps = false;

    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class);
    }
    public function perfilDesarrollador(): HasOne
    {
        return $this->hasOne(PerfilDesarrollador::class);
    }
    
    protected $fillable = [
        'nombre_usuario',
        'email',
        'password',
        'ruta_foto_usuario'
    ];

    protected $hidden = [
        'password',
    ];
}
