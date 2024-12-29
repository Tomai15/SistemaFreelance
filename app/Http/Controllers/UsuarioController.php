<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function mostrarMisPublicaciones(Request $request)
    {
        if(!session()->has('usuario')) {
            return redirect('/login')->with('error', 'Debe iniciar sesion previamente.');
        }

        $proyectos = session('usuario')->proyectos()->paginate(10);
        return view('perfil.mis-publicaciones',compact('proyectos'));
    }

    public function mostrarPostulantes(Proyecto $proyecto,Request $request)
    {
        if(!session()->has('usuario')) {
            return redirect('/login')->with('error', 'Debe iniciar sesion previamente.');
        }

        $postulantes = $proyecto->postulaciones()->with('perfilDesarrollador')->get()->map(function ($postulacion) {
            return $postulacion->perfilDesarrollador;
        })->filter();
        
        return view('proyectos.verPostulantes',compact('postulantes'));
    }
}
