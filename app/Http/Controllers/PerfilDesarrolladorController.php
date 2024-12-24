<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilDesarrolladorController extends Controller
{
    public function crearPerfil(Request $request)
    {
        return view('perfil.crearPerfil');
    }
}
