<?php

namespace App\Http\Controllers;

use App\Models\Tecnologia;
use Illuminate\Http\Request;

class PerfilDesarrolladorController extends Controller
{
    public function crearPerfil(Request $request)
    {
        $tecnologias = Tecnologia::all();
        // compact('tecnologias') == ['tecnologias' => $tecnologias]
        return view('perfil.crearPerfil',compact('tecnologias'));
    }
}
