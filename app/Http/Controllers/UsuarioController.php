<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function mostrarMisPublicaciones(Request $request)
    {
        $proyectos = session('usuario')->proyectos()->paginate(10);
        return view('perfil.mis-publicaciones',compact('proyectos'));
    }

    public function mostrarPostulantes(Proyecto $proyecto,Request $request)
    {
        $postulantes = $proyecto->postulantes;
        return view('proyectos.verPostulantes',compact('postulantes'));
    }
}
